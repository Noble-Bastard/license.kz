<?php

namespace App\Http\Controllers;

//use App\Data\Api\AlfaBankPayment;
use App\Data\Catalog\Dal\CatalogDal;
use App\Data\Catalog\Dal\ServiceCatalogDal;
use App\Data\Catalog\Dal\ServiceCategoryCatalogDal;
use App\Data\Catalog\Model\Catalog;
use App\Data\Core\Dal\NewsDal;
use App\Data\Core\Dal\ProfileDal;
use App\Data\Core\Dal\SettingDal;
use App\Data\Core\Model\ProfileLegal;
use App\Data\Document\Dal\DocumentDal;
use App\Data\Document\Model\Document;
use App\Data\FreeEconomicZone\Dal\FreeEconomicZoneDal;
use App\Data\Helper\Assistant;
use App\Data\Helper\CatalogTypeList;
use App\Data\Helper\FilePathHelper;
use App\Data\Helper\ReviewTypeList;
use App\Data\Helper\RoleList;
use App\Data\Helper\ServiceStatusList;
use App\Data\Notify\Dal\AMOCrm;
use App\Data\RegistrationForm\Dal\RegistrationFormDal;
use App\Data\RegistrationFormTemplate\Dal\RegistrationFormTemplateDal;
use App\Data\Service\Dal\CityDal;
use App\Data\Service\Dal\CountryDal;
use App\Data\Service\Dal\ServiceAdditionalRequirementsDal;
use App\Data\Service\Dal\ServiceCategoryDal;
use App\Data\Service\Dal\ServiceDal;
use App\Data\Service\Dal\ServiceStepMapDal;
use App\Data\Service\Dal\ServiceStepRequiredDocumentDal;
use App\Data\Service\Dal\ServiceStepResultDal;
use App\Data\Service\Dal\ServiceTypeDal;
use App\Data\Service\Model\Service;
use App\Data\Service\Model\ServiceStep;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Data\ServiceJournal\Dal\ServiceJournalServiceMapDal;
use App\Repositories\Interfaces\IReviewRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use stdClass;

class ServicesController extends Controller
{
    private $reviewRepository;

    public function __construct(IReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $countryId = 1;

        $categoryList = ServiceCategoryDal::getServiceCategoryWithoutSystemList(
            false,
            false,
            $countryId
        );

        $serviceTypeList = (new ServiceTypeDal())->getList(false, [], true);

        return view('services.index')
            ->with('categoryList', $categoryList)
            ->with('serviceTypeList', $serviceTypeList);
    }

    public function categoryList()
    {
        $countryId = CountryDal::getByCode(Assistant::getCountryLocation())->id;

        $newsList = NewsDal::getTopFiveActualNews();
        $categoryList = ServiceCategoryDal::getServiceCategoryWithoutSystemList(false, false, $countryId);

        return view('services.servicesCategoryList')
            ->with('categoryList', $categoryList)
            ->with('newsList', $newsList);
    }

    public function childNodesNew($serviceCategoryId)
    {
//        $serviceCategory = ServiceCategoryDal::get($serviceCategoryId, true);
        $rootNode = ServiceCategoryCatalogDal::getByServiceCategory($serviceCategoryId, true);
        return view('new.partials.page.catalogNodes')
            ->with('catalogRootNode', $rootNode);
    }

    public function serviceGroupInfoNew($serviceGroupName)
    {
        $currentNode = CatalogDal::getByPrettyName($serviceGroupName, true);
        if(is_null($currentNode)){
            abort(404);
        }

        $rootNode = CatalogDal::getRootNode($currentNode->id, true);
        $rootNode->category = ServiceCategoryCatalogDal::getByCatalog($rootNode->id, true);

        $reviewList = $this->reviewRepository->getTopByType(3, ReviewTypeList::Video);

        return view('new.pages.elements')
            ->with('rootNode', $rootNode)
            ->with('currentNode', $currentNode)
            ->with('reviewList', $reviewList);
    }

    public function serviceGroupCatalogNew($catalogName)
    {
        try {
            $currentNode = CatalogDal::getByPrettyName($catalogName, true);
            if(is_null($currentNode)){
                abort(404);
            }

            $service = CatalogDal::getFirstServiceByCatalogNode($currentNode->id);

            $currentNode->service = ServiceDal::get($service->id, true);

            return view('new.partials.page.services')
                ->with('currentNode', $currentNode);
        } catch (\Exception $e) {
            // Логируем ошибку
            \Log::error('Error in serviceGroupCatalogNew: ' . $e->getMessage());
            
            // Возвращаем простое HTML сообщение об ошибке
            return response('<div class="alert alert-danger text-center py-5"><h4>Ошибка загрузки данных</h4><p>Не удалось загрузить подвиды работ. Пожалуйста, обратитесь к администратору.</p><small>Техническая информация: ' . $e->getMessage() . '</small></div>', 500);
        }
    }

    /**
     * Быстрый API endpoint для получения только суммы и сроков (без HTML)
     */
    public function getServiceTotalsJson()
    {
        $selectedServices = Input::get('serviceId');
        
        if (empty($selectedServices)) {
            return response()->json(['error' => 'No services selected'], 400);
        }

        try {
            // Получаем только необходимые данные для расчета
            $serviceTotals = ServiceDal::getServiceTotals($selectedServices, null);
            
            return response()->json([
                'success' => true,
                'count' => count($selectedServices),
                'total_cost' => $serviceTotals->baseCostTotal,
                'total_days' => $serviceTotals->executionDaysTotal,
                'total_tax' => $serviceTotals->taxTotal ?? 0,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in getServiceTotalsJson: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to calculate totals'], 500);
        }
    }

    public function serviceGroupCompareNew()
    {
        $selectedServices = Input::get('serviceId');

        $serviceStepList = (new ServiceStepMapDal())->getListByServiceArray($selectedServices);

        $serviceAdditionalRequirements = (new ServiceAdditionalRequirementsDal())->getListByServiceArray($selectedServices, true);

        $serviceTotals = ServiceDal::getServiceTotals(
            $selectedServices,
            null
        );

        $serviceStepRequiredDocumentList = (new ServiceStepRequiredDocumentDal())->getListByServiceArray($selectedServices, true);

        $popularServiceList = [
            [
                'icon' => "/new/images/popular_service/handshake-outline.svg",
                "title" => "Полный комплекс услуг по сопровождению бизнеса",
                "cost" => 90000,
                "tag" => "Legalall",
                "comment" => "Полный оутсорсинг",
            ],
            [
                'icon' => "/new/images/popular_service/bank-outline.svg",
                "title" => "Открытие банковского счета",
                "cost" => 25000,
                "tag" => "bank",
                "comment" => "Банковский счет",
            ],
            [
                'icon' => "/new/images/popular_service/scale-balance.svg",
                "title" => "Юридическое сопровождение",
                "cost" => 40000,
                "tag" => "legaloutsourcing",
                "comment" => "Юридический оутсорсинг",
            ],
            [
                'icon' => "/new/images/popular_service/text-box-multiple-outline.svg",
                "title" => "Бухгалтерское сопровождение",
                "cost" => 40000,
                "tag" => "accountoutsourcing",
                "comment" => "Бухгалтерский оутсорсинг",
            ],
        ];

      $serviceContainsList = [
        [
          "title" => "Поиск и подготовка документов по требуемой технике и мат.тех.оснащенности",
          "img" => '/new/images/service_contains/cash.svg'
        ],
        [
          "title" => "Оплата суммы государственной пошлины",
          "img" => '/new/images/service_contains/bank-transfer.svg'
        ],
        [
          "title" => "Формирование и сбор документов юр.лица",
          "img" => '/new/images/service_contains/domain.svg'
        ],
        [
          "title" => "Поиск и подготовка необходимого штата специалистов для получения лицензии",
          "img" => '/new/images/service_contains/account-group-outline.svg'
        ],
        [
          "title" => "Заполнение анкет с прикреплением всех необходимых документов",
          "img" => '/new/images/service_contains/note-text-outline.svg'
        ],
        [
          "title" => "Подготовка и формирование документов",
          "img" => '/new/images/service_contains/text-box-check-outline.svg'
        ],
      ];

        return view('new.partials.page.service-compare')
            ->with('serviceStepList', $serviceStepList)
            ->with('serviceAdditionalRequirements', $serviceAdditionalRequirements)
            ->with('serviceTotals', $serviceTotals)
            ->with('popularServiceList', $popularServiceList)
            ->with('serviceContainsList', $serviceContainsList)
            ->with('serviceStepRequiredDocumentList', $serviceStepRequiredDocumentList)
            ;
    }

    public function getFreeZonePartial()
    {
        $activityTypeId = Input::get('activityTypeId');
        $licenseTypeId = Input::get('licenseTypeId');
        $countryRegionId = Input::get('countryRegionId');
        $showAll = Input::get('showAll');
        $freeZoneList = FreeEconomicZoneDal::getListByFilter(
            $activityTypeId,
            $licenseTypeId,
            $countryRegionId
        );

        return view('services._freeZoneList')
            ->with('freeZoneList', $showAll == 1 ? $freeZoneList : $freeZoneList->take(8));

    }

    public function serviceGroupList($serviceCategoryId)
    {
        $serviceCategory = ServiceCategoryDal::get($serviceCategoryId, true);
//        $countryId = CountryDal::getByCode(Assistant::getCountryLocation())->id;
//        $thematicGroupList = ServiceThematicGroupDal::getServiceThematicGroupListByCountryServiceCategory($serviceCategoryId, $countryId);
        if(!is_null($serviceCategory)) {
            $rootNode = ServiceCategoryCatalogDal::getByServiceCategory($serviceCategoryId, true);
        } else {
            $rootNode = CatalogDal::getByPrettyName($serviceCategoryId, true);
        }


//        if ($rootNode->childNodeList->count() > 0) {
//            foreach ($rootNode->childNodeList as $catalogItem) {
//                if ($catalogItem->serviceCatalogList->count() > 0) {
//                    $catalogItem->serviceTypeName = optional(optional($catalogItem->serviceCatalogList[0]->service)->serviceType)->name;
//                } else {
//                    if ($catalogItem->childNodeList->count() > 0) {
//                        $catalogItem->serviceTypeName = optional($this->getServiceType($catalogItem->childNodeList))->name;
//                    }
//                }
//            }
//        }

        if(is_null($rootNode)){
            abort(404);
        }

        return view('services.servicesThematicGroupList')
            ->with('catalogRootNode', $rootNode)
//            ->with('thematicGroupList', $thematicGroupList)
            ->with('serviceCategory', $serviceCategory);
    }

    private function getServiceType($childNodeList)
    {
        if (sizeof($childNodeList) == 0) {
            return null;
        }
        if ($childNodeList[0]->serviceCatalogList->count() > 0) {
            return $childNodeList[0]->serviceCatalogList[0]->service->serviceType;
        } else {
            return $this->getServiceType($childNodeList[0]->childNodeList);
        }
    }

    public function catalogNode(int $catalogId, $preSelected = null)
    {
        $catalogItem = CatalogDal::get($catalogId, true);
        $rootNode = CatalogDal::getRootNode($catalogId);
        $serviceCategory = ServiceCategoryCatalogDal::getByCatalog($rootNode->id, true);

        $serviceList = array();

        $serviceList = array_merge($serviceList, $catalogItem->serviceCatalogList->toArray());

        if (sizeof($serviceList) == 1) //redirect to service with out compare
        {
            return redirect(route('services.servicesCompare', ['service[]' => $serviceList[0]['service_id']]));
        }

        return view("catalog.catalogList")
            ->with('catalogRootNode', $catalogItem)
            ->with('serviceCategory', $serviceCategory)
            ->with('preSelected', $preSelected);
    }

    public function getCatalogNode($nodeId)
    {
        $catalogItem = CatalogDal::get($nodeId, true);

        return view("catalog._catalogList", ['catalogRootNode' => $catalogItem]);
    }

    public function choseServices($catalogId)
    {
        $catalogItem = CatalogDal::get($catalogId, true);
        return view("catalog.choseServices", ['catalogNode' => $catalogItem]);
    }

    public function show($serviceJournalId)
    {
        $serviceJournal = ServiceJournalDal::getExt($serviceJournalId);
        $serviceJournalStepList = ServiceJournalDal::getServiceJournalStepList($serviceJournalId);
        $manager = null;
        if ($serviceJournal->manager_id != null) {
            $manager = ProfileDal::get($serviceJournal->manager_id);
        }

        if (Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client) && $serviceJournal->client_id != ProfileDal::getByUserId(Auth::user()->id)->id) {
            return redirect(404);
        }

        $serviceJournalClientDocumentList = ServiceJournalDal::getServiceJournalClientDocumentList($serviceJournalId);
        $stepDocList = DocumentDal::getList($serviceJournalId);
        $serviceStepRequiredDocumentList = (new ServiceStepRequiredDocumentDal())->getByServiceJournal($serviceJournalId);

        $formGroupList = RegistrationFormTemplateDal::getRegistrationFormGroupTemplateList($serviceJournal->service_id);
        $formParameterList = RegistrationFormTemplateDal::getRegistrationFormParameterTemplateList($serviceJournal->service_id);
        $tableList = RegistrationFormTemplateDal::getTableMetadata($serviceJournal->service_id);

        $data = RegistrationFormDal::getRegistrationFormParametersByServiceJournal($serviceJournalId);
        $tableData = RegistrationFormDal::getTableData($serviceJournalId);

        $newsList = NewsDal::getTopFiveActualNews();
        return view('Client.service')
            ->with('serviceJournal', $serviceJournal)
            ->with('serviceJournalStepList', $serviceJournalStepList)
            ->with('serviceStepRequiredDocumentList', $serviceStepRequiredDocumentList)
            ->with('serviceJournalClientDocumentList', $serviceJournalClientDocumentList)
            ->with('formGroupList', $formGroupList)
            ->with('formParameterList', $formParameterList)
            ->with('tableList', $tableList)
            ->with('manager', $manager)
            ->with('data', $data)
            ->with('tableData', $tableData)
            ->with('newsList', $newsList)
            ->with('stepDocList', $stepDocList);
    }

    public function edit($serviceJournalId)
    {
        $serviceJournal = ServiceJournalDal::getExt($serviceJournalId);
        $serviceList = (new ServiceJournalServiceMapDal())->getServiceIdListByServiceJournalId($serviceJournalId);

        $serviceEntityList = [];
        foreach ($serviceList as $service) {
            $serviceEntity = new StdClass();
            $serviceEntity->serviceId = $service->service_id;
            $serviceEntity->formGroupList = RegistrationFormTemplateDal::getRegistrationFormGroupTemplateList($service->service_id);
            $serviceEntity->formParameterList = RegistrationFormTemplateDal::getRegistrationFormParameterTemplateList($service->service_id);
            $serviceEntity->tableList = RegistrationFormTemplateDal::getTableMetadata($service->service_id);
            array_push($serviceEntityList, $serviceEntity);
        }

        $data = RegistrationFormDal::getRegistrationFormParametersByServiceJournal($serviceJournalId);
        $tableData = RegistrationFormDal::getTableData($serviceJournalId);

        return view('Client.serviceJournalEditData')
            ->with('serviceJournal', $serviceJournal)
            ->with('serviceEntityList', $serviceEntityList)
            ->with('data', $data)
            ->with('tableData', $tableData);
    }

    public function sendToCheck($serviceJournalId)
    {
        $serviceJournal = ServiceJournalDal::getExt($serviceJournalId);

        if ($serviceJournal->service_status_id == ServiceStatusList::DataCollection) {
            ServiceJournalDal::setServiceJournalStatus($serviceJournalId, ServiceStatusList::Check);
        }

        return redirect()->back();
    }

    public function setData(Request $request)
    {
        $serviceJournalId = Input::get('serviceJournalId');
        $serviceId = Input::get('serviceId');

        $serviceJournal = ServiceJournalDal::getExt($serviceJournalId);
        $formParameterList = RegistrationFormTemplateDal::getRegistrationFormParameterTemplateList($serviceId);
        $tableList = RegistrationFormTemplateDal::getTableMetadata($serviceId);

        $validateField = [];
        $fieldType = "";
        foreach ($formParameterList as $formParameter) {
            switch ($formParameter->parameter_type_id) {
                case 1:
                    $fieldType = "required|string";
                    break;
                case 2:
                    $fieldType = "required|integer";
                    break;
                case 3:
                    $fieldType = "required|date";
                    break;
                case 4:
                    break;
                case 5:
                    $fieldType = "required|integer";
                    break;
                case 6:
//                    $table = collect($tableList)->where('tableParameterId', $formParameter->id)->first();
//                    foreach(collect($table->columnParameterList)->sortBy("order_number")->all() as $columnParameter){
//                        'paramerId_table_'.$formParameter->id.'_'.$columnParameter["id"]."*"
//                    }
                    break;
                case 7:
                    $fieldType = "required|email";
                    break;
                case 8:
                    $fieldType = "required|string|min:14|max:14";
                    break;

            }
            if ($formParameter->parameter_type_id != 4/*checkbox*/ && $formParameter->parameter_type_id != 6/*todo table*/) {
                $validateField["paramerId_" . $formParameter->id] = $fieldType;
            }
        }

        $messages = [
            'required' => 'Поле обязательно для заполнения.',
        ];

        Validator::make($request->all(), $validateField, $messages)->validate();

        $parameterValueList = [];
        $tableParameterValueList = [];
        foreach ($formParameterList as $formParameter) {
            if ($formParameter->parameter_type_id != 6) {
                $paramValue = Input::get("paramerId_" . $formParameter->id);
                array_push($parameterValueList, ['paramId' => $formParameter->id, 'paramValue' => $paramValue]);
            } else {
                $tableParameterList = collect($tableList)->where('tableParameterId', $formParameter->id)->first();
                $tableParameterValue = new stdClass();
                $tableParameterValue->tableParameterId = $formParameter->id;
                $tableParameterValue->columnParameterList = [];
                foreach ($tableParameterList->columnParameterList as $columnParameter) {
                    $parameterTableValue = Input::get("paramerId_table_" . $formParameter->id . "_" . $columnParameter["id"]);
                    for ($i = 1; $i < sizeof($parameterTableValue); $i++) {
                        array_push($tableParameterValue->columnParameterList, ['row_id' => $i, 'paramId' => $columnParameter["id"], 'paramValue' => $parameterTableValue[$i]]);
                    }
                }
                array_push($tableParameterValueList, $tableParameterValue);
            }
        }

        RegistrationFormDal::set($serviceJournalId, $serviceId, $parameterValueList, $tableParameterValueList);

        return redirect(route('Client.serviceJournal.show', ['serviceJournalId' => $serviceJournalId]));
    }

    public function serviceInfo($serviceId)
    {

        $newsList = NewsDal::getTopFiveActualNews();
        $serviceCategory = ServiceCategoryDal::getServiceCategoryByService(intval($serviceId));
        $service = ServiceDal::get($serviceId, true);
        $serviceStepList = (new ServiceStepMapDal())->getExtByService($serviceId, true);

        $serviceStepResultList = (new ServiceStepResultDal())->getByService($serviceId);
        $serviceStepRequiredDocumentList = (new ServiceStepRequiredDocumentDal())->getByService($serviceId);

        return view('services.serviceInfo')
            ->with('newsList', $newsList)
            ->with('service', $service)
            ->with('serviceCategory', $serviceCategory)
            ->with('serviceStepResultList', $serviceStepResultList)
            ->with('serviceStepRequiredDocumentList', $serviceStepRequiredDocumentList)
            ->with('serviceStepList', $serviceStepList);

    }


    public function servicesCompare()
    {
        $selectedServices = Input::get('service');
//        $newsList = NewsDal::getTopFiveActualNews();
        $serviceCategory = ServiceCategoryDal::getServiceCategoryByService(intval($selectedServices[0]));

        $catalogNode = ServiceCatalogDal::getNodeByService(intval($selectedServices[0]));
        $license = CatalogDal::getParentNodeByType($catalogNode->catalog_id, CatalogTypeList::WHITE_BOX_WITH_ICON);

        $license = CatalogDal::get($license->id, true);

        $serviceList = ServiceDal::getListByIdArray($selectedServices, true);
        $serviceStepList = (new ServiceStepMapDal())->getListByServiceArray($selectedServices);

        $requiredDocumentList = (new ServiceStepRequiredDocumentDal())->getListByServiceArray($selectedServices, true);
        $serviceStepResultList = (new ServiceStepResultDal())->getListByServiceArray($selectedServices, true);

        $serviceAdditionalRequirements = (new ServiceAdditionalRequirementsDal())->getListByServiceArray($selectedServices, true);
        $mrp = SettingDal::getMrp();

        $serviceTotals = ServiceDal::getServiceTotals(
            $selectedServices,
            null
        );

        return view('services.serviceCompareInfo')
//            ->with('newsList', $newsList)
            ->with('serviceList', $serviceList)
            ->with('serviceCategory', $serviceCategory)
            ->with('serviceStepList', $serviceStepList)
            ->with('serviceStepRequiredDocumentList', $requiredDocumentList)
            ->with('serviceStepResultList', $serviceStepResultList)
            ->with('mrp', $mrp)
            ->with('serviceAdditionalRequirements', $serviceAdditionalRequirements)
            ->with('serviceTotals', $serviceTotals)
            ->with('license', $license);
    }

    public function paymentInfo(Request $request)
    {
        $selectedServices = explode(',', Input::get('serviceList'));
        $catalogNode = ServiceCatalogDal::getNodeByService(intval($selectedServices[0]));
        $license = CatalogDal::getParentNodeByType($catalogNode->catalog_id, CatalogTypeList::WHITE_BOX_WITH_ICON);

        $license = CatalogDal::get($license->id, true);
        $serviceTotals = ServiceDal::getServiceTotals(
            $selectedServices,
            null
        );
        $serviceList = ServiceDal::getListByIdArray($selectedServices, true);
        return view('services.paymentInfo')
            ->with('serviceList', $serviceList)
            ->with('serviceTotals', $serviceTotals)
            ->with('license', $license);;
    }

    public function order(Request $request)
    {
        $profileLegal = null;
        $getInfoLater = Input::get("provideCompanyInfoLater") == "on";
        $paymentTypeId = Input::get("paymentTypeId");
        $selectedCityId = Input::get("selectedCity");
        if (!$getInfoLater) {
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

            $profileLegal = $this->getProfileLegalFromRequest();
            if ($validator->fails()) {
                return view('_legalProfileCard')
                    ->with('errors', $validator->errors())
                    ->with('autoFocus', true)
                    ->with('isNewProfile', false)
                    ->with('profileLegal', $profileLegal);
            }
        }

        $serviceIdList = explode(",", Input::get("serviceIdList"));
        $serviceJournal = ServiceJournalDal::newServiceRequest($serviceIdList, $profileLegal, $paymentTypeId, $selectedCityId);

        return response()->json(['serviceJournal' => $serviceJournal]);
    }

    private function getProfileLegalFromRequest(): ProfileLegal
    {
        $profileLegal = new ProfileLegal();
        $profileLegal->company_name = Input::get("full_name");
        $profileLegal->full_name = Input::get("full_name");
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

    public function tempTemplate()
    {
        $newsList = NewsDal::getTopFiveActualNews();
        return view('Client.tempTemplate')->with('newsList', $newsList);
    }

    public function stepReqDocList($serviceStep, $serviceJournal)
    {
        $serviceIdList = (new ServiceJournalServiceMapDal())->getServiceIdListByServiceJournalId($serviceJournal)->toArray();
        $serviceStepRequiredDocumentList = (new ServiceStepRequiredDocumentDal())->getByServiceStep($serviceStep, $serviceIdList);
        return view('Client._serviceDocList')
            ->with('serviceStepId', $serviceStep)
            ->with('serviceJournalId', $serviceJournal)
            ->with('serviceStepRequiredDocumentList', $serviceStepRequiredDocumentList);
    }

    public function addStepDocument(Request $request)
    {
        $serviceStepId = $request->get('serviceStepId');
        $serviceJournalId = $request->get('serviceJournalId');
        $documentId = $request->get('documentId');

      $originalName = $request->file('doc')->getClientOriginalName();

      $path = FilePathHelper::getServiceJournalClientPath($serviceJournalId).'/'.$originalName;

      Storage::put($path, file_get_contents($request->file('doc')));

//        $path = $request->file('doc')->store(FilePathHelper::getServiceJournalClientPath($serviceJournalId));

        $document = new Document();
        $document->path = $path;
        $document->name = $request->get('docName');

        ServiceJournalDal::addServiceJournalClientDocument($serviceJournalId, $serviceStepId, $document, $request->get('docName'), $documentId);

//        return redirect(route('Client.serviceJournal.show',$serviceJournalId));

        $serviceJournal = ServiceJournalDal::getExt($serviceJournalId);

        return view('Client._serviceJournalClientDocument')
            ->with('serviceJournal', $serviceJournal);
    }

    public function deleteDocument($serviceJournalId, $serviceJournalClientDocumentId, $isactive)
    {

        ServiceJournalDal::setServiceJournalClientDocActiveStatus($serviceJournalClientDocumentId, $isactive);

        $serviceJournal = ServiceJournalDal::getExt($serviceJournalId);

        return view('Client._serviceJournalClientDocument')
            ->with('serviceJournal', $serviceJournal);
    }


    public static function getServiceTotals(Request $request)
    {

        $serviceIdList = $request->get('serviceIdList');
        $serviceStepIdList = $request->get('serviceStepIdList');

        $serviceTotals = ServiceDal::getServiceTotals(
            $serviceIdList,
            $serviceStepIdList
        );

        return response()->json($serviceTotals);
    }

    public function setPayment($serviceJournalId)
    {
//        $serviceJournal = ServiceJournalDal::get($serviceJournalId);
//        $serviceJournalPayment = ServiceJournalDal::getPaymentByServiceJournalId($serviceJournalId);
//        $alfaBankPayment = new AlfaBankPayment();
//        $alfaBankPayment->registerOrder(serviceGroupList
//            $serviceJournal->service_no,
//            $serviceJournalPayment->amount,
//            $serviceJournalPayment->tax,
//            $serviceJournalPayment->currency->code,
//            route('Client.serviceJournal.successPayment', ['servicesJournalId' => $serviceJournalId]),
//            $serviceJournal->id
//        );
    }

    public function sendCommercialOffer(Request $request)
    {
        (new ServiceDal())->sendCommercialOffer($this->prepareParamsForSend($request, 'Запрошенно КП по ', 'license-kz-callback'));
    }

    public function sendServiceRequirement(Request $request)
    {
        (new ServiceDal())->sendServiceRequirement($this->prepareParamsForSend($request, 'Запрошены требования по ', 'license-kz-requierments'));
    }

    private function prepareParamsForSend(Request $request, $info, $amoChannel)
    {
        $name = $request->get('name');
        $phone = $request->get('phone');
        $email = $request->get('email');

        $params = [
            'name' => $name,
            'phone' => $phone,
            'serviceIdList' => $request->get('serviceIdList'),
            'emailToSend' => $email
        ];
        if(!Auth::user() || Auth::user()->isUserInRole(RoleList::Client)) {

            $comment = '';
            foreach ($params['serviceIdList'] as $serviceId) {
                $service = ServiceDal::get($serviceId);
                $comment .= $service->name . ' | ';
            }
          $roistatVisitId = array_key_exists('roistat_visit', $_COOKIE) ? $_COOKIE['roistat_visit'] : "неизвестно";
            (new AMOCrm())->callMe($amoChannel, $name, $phone, $email, $info . ' ' . $comment, $info, null, $roistatVisitId);
        }

        return $params;
    }

    public function preOrder()
    {
        $profileLegal = !is_null(Auth::user()) ? ProfileDal::getByUserId(Auth::user()->id) : new ProfileLegal();

        return view('services.preOrder')
            ->with('serviceList', Input::get('serviceList'))
            ->with('selectedCity', Input::get('selectedCity'))
            ->with('profileLegal', $profileLegal);
    }

    public function setPaymentType()
    {
        return view('services.setPaymentType')
            ->with('cityList', CityDal::getListByCountry(1, false, true))
            ->with('serviceList', Input::get('serviceList'));
    }

    public function successPayment($serviceJournalId)
    {
        //todo
    }

    public function failPayment($serviceJournalId)
    {
        //todo
    }

    public function search()
    {
        $result = ServiceDal::search(Input::get('query'));
        return $result;
    }

    public function searchSelected($serviceCatalogId, $serviceId)
    {
        $catalogNode = CatalogDal::getParentNodeByType($serviceCatalogId, CatalogTypeList::WHITE_BOX_WITH_ICON);
        return redirect(route('services.catalog.list', ['catalogId' => $catalogNode->id, 'preSelected' => $serviceId]));
    }

    public function listByServiceCategoryAndType()
    {
        $serviceCategoryId = Input::get('selectCategory');
        $type = Input::get('type');

        $rootNode = ServiceCategoryCatalogDal::getByServiceCategory($serviceCategoryId, true);

        $result = [];

        if ($rootNode->childNodeList->count() > 0) {
            foreach ($rootNode->childNodeList as $catalogItem) {
                if ($catalogItem->serviceCatalogList->count() > 0) {
                    $catalogItem->serviceTypeName = optional(optional($catalogItem->serviceCatalogList[0]->service)->serviceType)->name;
                    $catalogItem->serviceTypeId = optional(optional($catalogItem->serviceCatalogList[0]->service)->serviceType)->id;

                    if ($catalogItem->serviceTypeId == $type) {
                        array_push($result, $catalogItem);
                    }
                } else {
                    if ($catalogItem->childNodeList->count() > 0) {
                        $serviceType = $this->getServiceType($catalogItem->childNodeList);
                        $catalogItem->serviceTypeName = $serviceType->name;
                        $catalogItem->serviceTypeId = $serviceType->id;

                        if ($serviceType->id == $type) {
                            array_push($result, $catalogItem);
                        }
                    }
                }
            }
        }

        foreach ($result as $item) {
            $services = Catalog::with('children')
                ->where('catalog.catalog_parent_id', $item->id)
                ->orWhere('catalog.id', $item->id)
                ->join('service_catalog', 'catalog.id', '=', 'service_catalog.catalog_id')
                ->join('service', 'service.id', '=', 'service_catalog.service_id')
                ->select('service.id')
                ->get();

            $base_cost_list = Service::whereIn('id', $services)
                ->with('latestServiceCostHist')
                ->get()
                ->sortByDesc('latestServiceCostHist.base_cost');

            $executionDays = ServiceStep::join('service_step_map', function ($join) use ($services) {
                $join->on('service_step_map.service_step_id', '=', 'service_step.id')
                    ->whereIn('service_step_map.service_id', $services);
            })->selectRaw('service_step_map.service_id, sum(execution_work_day_cnt) as sum')
                ->groupBy('service_step_map.service_id')->get();

            $item->min_cost = number_format($base_cost_list[0]->latestServiceCostHist->base_cost, 0, ',', ' ') . ' тг';
            $item->min_execution_days = collect($executionDays)->min('sum');
        }

        return $result;
    }

    public function constructionServices()
    {
        // Получаем узел строительства по pretty_url (как в serviceGroupInfoNew)
        $currentNode = CatalogDal::getByPrettyName('stroitelno_montazhnye_raboty', true);
        
        if(is_null($currentNode)){
            abort(404, 'Страница строительства не найдена');
        }

        // Получаем корневой узел и категорию (как в serviceGroupInfoNew)
        $rootNode = CatalogDal::getRootNode($currentNode->id, true);
        $rootNode->category = ServiceCategoryCatalogDal::getByCatalog($rootNode->id, true);

        // Получаем дочерние узлы (категории строительных лицензий: I, II, III)
        $documentTypes = collect($currentNode->childNodeList)->where('is_visible', 1)->sortBy('order_no')->values();
        
        // Для каждой категории получаем полную информацию с услугами
        foreach($documentTypes as $documentType) {
            // Загружаем дочерние узлы (подвиды работ)
            $catalogList = collect($documentType->childNodeList->where('is_visible', 1)->all())->sortBy('name');
            
            if(sizeof($catalogList) === 0){
                $catalogList = [$documentType];
            }
            
            $documentType->catalogList = $catalogList;
            
            // Для каждого подвида загружаем услуги
            foreach($catalogList as $catalogItem) {
                $catalogSubList = collect($catalogItem->childNodeList->where('is_visible', 1)->all())->sortBy('name');
                $catalogItem->catalogSubList = $catalogSubList;
            }
            
            // НЕ загружаем service через ServiceDal::get() - это обращается к service_ext view который тупит
            // Вместо этого просто используем базовые данные из serviceCatalogList
            $documentType->service = null; // Можно добавить базовую стоимость позже если нужно
        }

        // Получаем отзывы (как в serviceGroupInfoNew)
        $reviewList = $this->reviewRepository->getTopByType(3, ReviewTypeList::Video);

        // Получаем полезную информацию
        $usefulInformationList = $rootNode->category->usefulInformations ?? collect();

        return view('construction-new')
            ->with('rootNode', $rootNode)
            ->with('currentNode', $currentNode)
            ->with('documentTypes', $documentTypes)
            ->with('reviewList', $reviewList)
            ->with('usefulInformationList', $usefulInformationList);
    }

}
