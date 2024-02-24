<?php

namespace App\Http\Controllers;

use App\Data\Core\Dal\ProfileDal;
use App\Data\Core\Model\ProfileLegal;
use App\Data\Service\Dal\CityDal;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Repositories\Interfaces\IExtraServiceQuestionRepository;
use App\Repositories\Interfaces\IExtraServiceQuestionValueRepository;
use App\Repositories\Interfaces\IExtraServiceRepository;
use App\Repositories\Interfaces\IExtraServiceStepRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class ExtraServicesController extends Controller
{
  private IExtraServiceRepository $extraServiceRepository;
  private IExtraServiceQuestionRepository $extraServiceQuestionRepository;
  private IExtraServiceQuestionValueRepository $extraServiceQuestionValueRepository;
  private IExtraServiceStepRepository $extraServiceStepRepository;

  public function __construct(
    IExtraServiceRepository              $extraServiceRepository,
    IExtraServiceQuestionRepository      $extraServiceQuestionRepository,
    IExtraServiceQuestionValueRepository $extraServiceQuestionValueRepository,
    IExtraServiceStepRepository          $extraServiceStepRepository
  )
  {
    $this->extraServiceRepository = $extraServiceRepository;
    $this->extraServiceQuestionRepository = $extraServiceQuestionRepository;
    $this->extraServiceQuestionValueRepository = $extraServiceQuestionValueRepository;
    $this->extraServiceStepRepository = $extraServiceStepRepository;
  }

  public function index($serviceCode)
  {
    $extraService = $this->extraServiceRepository->getByCode($serviceCode);

    if (!$extraService) {
      abort(404);
    }
    $questionList = $this->extraServiceQuestionRepository->getByExtraService($extraService->id);
    foreach ($questionList as $question) {
      $question->values = $this->extraServiceQuestionValueRepository->getByQuestion($question->id);
    }

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

    return view('new.pages.extra_services.index')
      ->with('extraService', $extraService)
      ->with('questionList', $questionList)
      ->with('popularServiceList', $popularServiceList);
  }

  public function steps()
  {
    $selectedQuestionValueCode = Input::get('questionValueCode');
    $extraServiceId = Input::get('extraServiceId');

    $stepList = $this->extraServiceStepRepository->getList($selectedQuestionValueCode);
    $extraService = $this->extraServiceRepository->find($extraServiceId);

    return view('new.pages.extra_services.stepList')
      ->with('stepList', $stepList)
      ->with('extraService', $extraService);
  }

  public function paymentInfo()
  {
    $serviceStepIdList = explode(',', Input::get('serviceStepIdList'));
    $extraServiceCode = Input::get('extraServiceCode');

    if(is_null($serviceStepIdList) || is_null($extraServiceCode)){
      abort(404);
    }

    $extraService = $this->extraServiceRepository->getByCode($extraServiceCode);
    $stepHeaderData = $this->extraServiceStepRepository->getListByIdList($serviceStepIdList);

    $stepHeader = new \stdClass();
    $stepHeader->totalDay = $stepHeaderData->sum('totalDay');
    $stepHeader->cost = $stepHeaderData->sum('cost');

    return view('new.pages.extra_services.paymentInfo')
      ->with('stepHeader', $stepHeader)
      ->with('stepList', $serviceStepIdList)
      ->with('extraService', $extraService);
  }

  public function setPaymentType()
  {
    return view('new.pages.extra_services.setPaymentType')
      ->with('cityList', CityDal::getListByCountry(1, false, true))
      ->with('serviceStepIdList', Input::get('serviceStepIdList'))
      ->with('extraServiceCode', Input::get('extraServiceCode'));
  }

  public function preOrder()
  {
    $profileLegal = !is_null(Auth::user()) ? ProfileDal::getByUserId(Auth::user()->id) : new ProfileLegal();

    return view('new.pages.extra_services.preOrder')
      ->with('serviceStepIdList', Input::get('serviceStepIdList'))
      ->with('extraServiceCode', Input::get('extraServiceCode'))
      ->with('selectedCity', Input::get('selectedCity'))
      ->with('profileLegal', $profileLegal);
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

    $serviceStepIdList = explode(",", Input::get("serviceStepIdList"));
    $extraServiceCode = Input::get("extraServiceCode");

    $stepHeaderData = $this->extraServiceStepRepository->getListByIdList($serviceStepIdList);

    $serviceJournal = ServiceJournalDal::newExtraServiceRequest($stepHeaderData, $extraServiceCode, $profileLegal, $paymentTypeId, $selectedCityId);

    return response()->json(['serviceJournal' => $serviceJournal]);
  }
}
