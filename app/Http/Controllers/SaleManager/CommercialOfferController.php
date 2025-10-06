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
        try {
            // Получаем данные из формы
            $licenseName = Input::get('license_name');
            $subspecies = Input::get('subspecies');
            $authorizedBody = Input::get('authorized_body');
            $additionalRequirements = Input::get('additional_requirements');
            $requiredDocuments = Input::get('required_documents');
            $stateDutyCost = Input::get('state_duty_cost');
            $servicePeriod = Input::get('service_period');
            $cost = Input::get('cost');
            $clientName = Input::get('client_name');
            $clientEmail = Input::get('client_email');
            $clientPhone = Input::get('client_phone');
            $serviceIds = Input::get('service_ids');

            // Создаем объект КП
            $customService = new \stdClass();
            $customService->licenseName = $licenseName ?: 'Коммерческое предложение';
            $customService->serviceList = $subspecies ? explode(';', $subspecies) : [];
            $customService->executive_agency = $authorizedBody ?: 'Уполномоченный орган';
            $customService->tax = $stateDutyCost ?: 0;
            $customService->executionWorkDay = $servicePeriod ?: '30 дней';
            $customService->serviceAdditionalRequirements = $additionalRequirements ? explode(';', $additionalRequirements) : [];
            $customService->serviceRequiredDocument = $requiredDocuments ? explode('.', $requiredDocuments) : [];
            $customService->cost = $cost ?: 0;

            $params = [
                'name' => $clientName,
                'phone' => $clientPhone,
                'serviceIdList' => $serviceIds ? explode(';', $serviceIds) : [],
                'emailToSend' => $clientEmail
            ];
            
            (new ServiceDal())->createCommercialOffer($params, CommercialOfferTypeList::commercialOffer);

            $commercialOffer = (new CustomCommercialOfferDocumentManager($customService))->getPdfFileName();

            $emailEntity = new EmailJournal();
            $emailEntity->recipients = $clientEmail;
            $emailEntity->subject = 'Коммерческое предложение';
            $emailEntity->email_notify_type_id = EmailNotifyTypeList::NewMessage;

            $attachList = array();
            $attach = new \stdClass();
            $attach->file_path = $commercialOffer;
            $attach->name = 'Коммерческое предложение';
            array_push($attachList, $attach);

            (new CommercialOfferNotification($emailEntity, $attachList))->setData();

            // Проверяем, это AJAX запрос или обычный
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'КП успешно создано!'
                ]);
            }

            return redirect(route('sale_manager.commercial_offer.index'));
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Ошибка: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Ошибка: ' . $e->getMessage());
        }
    }

    public function prepareServiceById()
    {
        try {
            $ids = request()->input('ids');
            if (!$ids) {
                return response()->json([
                    'success' => false,
                    'error' => 'ID подвидов не указаны'
                ], 400);
            }

            $serviceIdList = explode(';', $ids);

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
            $result->license_name = $license->name;
            $result->subspecies = $serviceList->unique('name')->implode('name', '; ');
            $result->authorized_body = $serviceList[0]->executive_agency;
            $result->state_duty_cost = $serviceTotals->stepTaxMRPTotal;
            $result->service_period = $serviceTotals->executionWorkDayTotal;
            $result->required_documents = implode('; ', $documentList);

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

            $result->additional_requirements = implode(';', $serviceAdditionalRequirements);
            $result->cost = $serviceTotals->stepCostTotal;
            
            return response()->json([
                'success' => true,
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Ошибка при загрузке данных: ' . $e->getMessage()
            ], 500);
        }
    }
}