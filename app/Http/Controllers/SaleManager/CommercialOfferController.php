<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-01-17
 * Time: 7:58 PM
 */

namespace App\Http\Controllers\SaleManager;


use App\Data\Catalog\Dal\CatalogDal;
use App\Data\Catalog\Dal\ServiceCatalogDal;
use App\Data\Core\Dal\ProfileDal;
use App\Data\Core\Dal\SettingDal;
use App\Data\DocumentTemplate\CommercialOfferDocumentManager;
use App\Data\DocumentTemplate\CustomCommercialOfferDocumentManager;
use App\Data\Helper\CatalogTypeList;
use App\Data\Helper\EmailNotifyTypeList;
use App\Data\Helper\RoleList;
use App\Data\Notify\Model\EmailJournal;
use App\Data\Service\Dal\CommercialOfferDal;
use App\Data\Service\Dal\ServiceAdditionalRequirementsDal;
use App\Data\Service\Dal\ServiceDal;
use App\Data\Service\Dal\ServiceStepMapDal;
use App\Data\Service\Dal\ServiceStepRequiredDocumentDal;
use App\Data\Service\Helper\CommercialOfferTypeList;
use App\Data\Service\Model\CommercialOffer;
use App\Mail\CommercialOfferNotification;
use Illuminate\Support\Facades\Input;

class CommercialOfferController
{
    public function index()
    {
        $commercialOfferList = (new CommercialOfferDal())->getList(true, ['serviceList.service', 'type']);

        return view('SaleManager.commercial_offer.index')
            ->with('commercialOfferList', $commercialOfferList);
    }

    public function create()
    {
        return view('SaleManager.commercial_offer.create');
    }

    public function store()
    {
        $customService = new \stdClass();
        $customService->licenseName = Input::get('serviceName');
        $customService->serviceList = explode (';', Input::get('serviceList'));
        $customService->executive_agency = Input::get('executiveAgency');
        $customService->tax = Input::get('tax');
        $customService->executionWorkDay = Input::get('executionWorkDay');
        $customService->serviceAdditionalRequirements = [];
        if(Input::get('serviceAdditionalRequirements')){
            $reqList = explode('||', Input::get('serviceAdditionalRequirements'));
            foreach ($reqList as $req){
                array_push($customService->serviceAdditionalRequirements, $req);
            }
        }
        $customService->serviceRequiredDocument = Input::get('serviceRequiredDocument') != null ? explode (';', Input::get('serviceRequiredDocument')) : null;
        $customService->cost = Input::get('cost');

        $name = Input::get('name');
        $phone = Input::get('phone');
        $email = Input::get('emailToSend');

        $params = [
            'name' => $name,
            'phone' => $phone,
            'serviceIdList' => [],
            'emailToSend' => $email
        ];
        (new ServiceDal())->createCommercialOffer($params, CommercialOfferTypeList::commercialOffer);

        $commercialOffer = (new CustomCommercialOfferDocumentManager($customService))->getPdfFileName();

        $emailEntity = new EmailJournal();
        $emailEntity->recipients = Input::get('emailToSend');
        $emailEntity->subject = trans('messages.services.commercialOffer.email_title');
        $emailEntity->email_notify_type_id = EmailNotifyTypeList::NewMessage;

        $attachList = array();
        $attach = new \stdClass();
        $attach->file_path = $commercialOffer;
        $attach->name = trans('messages.services.commercialOffer.email_title');
        array_push($attachList, $attach);

        (new CommercialOfferNotification($emailEntity, $attachList))->setData();

        return redirect(route('sale_manager.commercial_offer.index'));
    }

    public function prepareServiceById()
    {
        $serviceIdList = explode(';', Input::get('idList'));

        $catalogNode = ServiceCatalogDal::getNodeByService(intval($serviceIdList[0]));
        $license = CatalogDal::getParentNodeByType($catalogNode->catalog_id, CatalogTypeList::WHITE_BOX_WITH_ICON);

        $serviceList = ServiceDal::getListByIdArray($serviceIdList, true);
        $serviceAdditionalRequirementsList = (new ServiceAdditionalRequirementsDal())->getListByServiceArray($serviceIdList, true);
        $serviceStepList = (new ServiceStepMapDal())->getListByServiceArray($serviceIdList);
        $requiredDocumentList = (new ServiceStepRequiredDocumentDal())->getListByServiceArray($serviceIdList, true);
        $serviceTotals = ServiceDal::getServiceTotals($serviceIdList, null);

        $serviceStep = $serviceStepList[0];
        $curStepRequiredDocument = $requiredDocumentList->where('service_step_id', $serviceStep->service_step_id)->all();
        $documentList = [];
        foreach($curStepRequiredDocument as $stepRequiredDocument){
            array_push($documentList, $stepRequiredDocument->serviceRequiredDocumentWithTranslate->description);
        }
        $result = new \stdClass();
        $result->serviceName = $license->name;
        $result->serviceList = $serviceList->unique('name')->implode('name', '; ');
        $result->executiveAgency = $serviceList[0]->executive_agency;
        $result->tax = $serviceTotals->stepTaxMRPTotal;
        $result->executionWorkDay = $serviceTotals->executionWorkDayTotal;
        $result->serviceRequiredDocument = implode('; ', $documentList);

        $serviceAdditionalRequirements = [];
        foreach($serviceAdditionalRequirementsList->groupBy('name') as $type => $valueList){
            $serviceAdditionalRequirementsItem = '';
            $serviceAdditionalRequirementsItem .= $type . ": ";
            $numItems = count($valueList);
            $j = 0;
            foreach ($valueList->sortBy('description') as $value) {
                $serviceAdditionalRequirementsItem .= $value->description . (++$j === $numItems ? '' : ', ');
            }

            array_push($serviceAdditionalRequirements, $serviceAdditionalRequirementsItem);
        }

        $result->serviceAdditionalRequirements = implode('||', $serviceAdditionalRequirements);
        $result->cost = $serviceTotals->stepCostTotal;
        return response()->json($result);
    }
}