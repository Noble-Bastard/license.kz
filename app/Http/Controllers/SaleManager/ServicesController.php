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
}
