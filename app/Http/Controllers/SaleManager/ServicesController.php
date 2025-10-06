<?php

namespace App\Http\Controllers\SaleManager;

use App\Data\Core\Dal\ProfileDal;
use App\Data\Core\Model\ProfileLegal;
use App\Data\Helper\RoleList;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Data\ServiceJournal\Dal\ServiceJournalProfileLegalDal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{


    public function serviceList($service_status_id=1)
    {
        $serviceJournalList = ServiceJournalDal::getServiceJournalListbyStatus(true,$service_status_id);
        $managerList = ProfileDal::getListByRoles(array(RoleList::Manager),false);
        $statusList=ServiceJournalDal::getServiceJournalStatusList();


        return view('SaleManager.service.index')
            ->with('managerList', $managerList->pluck('full_name', 'id'))
            ->with('serviceJournalList', $serviceJournalList)
            ->with('statusList',$statusList)
            ->with('service_status_id',$service_status_id);
    }

    public function serviceListByStatus($service_status_id)
    {
        return self::serviceList($service_status_id);
    }

    public function serviceDetail($serviceJournalId)
    {
        $serviceJournal = ServiceJournalDal::getExt($serviceJournalId);
        $serviceJournal->load('serviceStatus', 'manager', 'client', 'service');
        
        // Get service steps with documents and comments
        $serviceJournalStepList = ServiceJournalDal::getServiceJournalStepList($serviceJournalId);
        
        // Add documents and comments to each step
        foreach ($serviceJournalStepList as $step) {
            // Get step documents - пока без привязки к шагу, так как нет колонки service_journal_step_id
            $stepDocuments = collect(); // Пока пустая коллекция
            $step->documents = $stepDocuments;
            
            // Get step comments - пока без привязки к шагу, так как нет колонки service_journal_step_id
            $stepComments = collect(); // Пока пустая коллекция
            $step->comments = $stepComments;
        }
        
        // Get general documents for the service
        $documents = $serviceJournal->clientDocumentList;
        
        // Get general messages for the service
        $messages = \App\Data\ServiceJournal\Model\ServiceJournalMessage::with(['message', 'createdBy'])
            ->where('service_journal_id', $serviceJournalId)
            ->orderBy('create_date', 'asc')
            ->get();
        
        // Get executor information
        $executor = null;
        if ($serviceJournal->manager_id) {
            $executor = \App\Data\Core\Dal\ProfileDal::get($serviceJournal->manager_id);
        }
        
        return view('SaleManager.service.detail')
            ->with('serviceJournal', $serviceJournal)
            ->with('serviceJournalStepList', $serviceJournalStepList)
            ->with('documents', $documents)
            ->with('messages', $messages)
            ->with('executor', $executor);
    }


    public function setManager()
    {
        $serviceJournalId = Input::get('serviceJournalId');
        $managerId = Input::get('manager');
        $prepaymentPercent = Input::get('prepayment_percent');
        ServiceJournalDal::setPrepaymentPercent($serviceJournalId, $prepaymentPercent / 100);
        ServiceJournalDal::assignServiceJournalManager($serviceJournalId, $managerId);

        return redirect(URL::previous());
    }


    public function setProfileLegalInfo(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'legal_address' => 'required|string|max:512',
            'director_name' => 'required|string|max:128',
            'bank_code' => 'required|string|max:128',
            'bank_code_type_id' => 'required|numeric',
            'business_identification_number' => 'required|string|max:16',
            'contact_person' => 'required|string|max:128',
            'position' => 'required|string|max:255',
            'scope_activity' => 'required|string|max:1024'
        ]);

        $serviceJournalId = Input::get('serviceJournalId');
        $serviceJournalProfileLegal = $this->getProfileLegalFromRequest();
        if ($validator->fails()) {
            $serviceJournalProfileLegal->full_name = Input::get("full_name");
            return view('_legalProfileCard')
                ->with('errors', $validator->errors())
                ->with('autoFocus', true)
                ->with('isNewProfile', false)
                ->with('profileLegal', $serviceJournalProfileLegal);
        };

        $serviceJournalProfileLegal->service_journal_id = $serviceJournalId;
        (new ServiceJournalProfileLegalDal)->set($serviceJournalProfileLegal);

        return response()->json(['serviceJournalId'=>$serviceJournalId]);
    }

    private function getProfileLegalFromRequest(): ProfileLegal
    {
        $profileLegal = new ProfileLegal();
        $profileLegal->company_name = Input::get("full_name");
        $profileLegal->bank_code_type_id = Input::get("bank_code_type_id");
        $profileLegal->bank_code = Input::get("bank_code");
        $profileLegal->director_name = Input::get("director_name");
        $profileLegal->legal_address = Input::get("legal_address");
        $profileLegal->business_identification_number = Input::get("business_identification_number");
        $profileLegal->contact_person = Input::get("contact_person");
        $profileLegal->position = Input::get("position");
        $profileLegal->scope_activity = Input::get("scope_activity");
        return $profileLegal;
    }

    public function setInWork($serviceJournal)
    {
        ServiceJournalDal::startExecution($serviceJournal);
        return redirect(URL::previous());
    }

    /**
     * Return Sale Manager service details modal content (Figma-styled partial).
     */
    public function serviceJournalModal($servicesJournalId)
    {
        $serviceJournal = ServiceJournalDal::getExt($servicesJournalId);
        $serviceJournalStepList = ServiceJournalDal::getServiceJournalStepList($servicesJournalId);

        return view('SaleManager.service._details_modal')
            ->with('serviceJournal', $serviceJournal)
            ->with('serviceJournalStepList', $serviceJournalStepList);
    }
}
