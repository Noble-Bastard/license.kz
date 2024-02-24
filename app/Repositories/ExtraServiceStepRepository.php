<?php

namespace App\Repositories;

use App\Data\ExtraService\Model\ExtraService;
use App\Data\ExtraService\Model\ExtraServicesStepHeaders;
use App\Data\Translation\Dal\TranslationDal;
use App\Repositories\Interfaces\IExtraServiceDocumentsRepository;
use App\Repositories\Interfaces\IExtraServiceQuestionMapRepository;
use App\Repositories\Interfaces\IExtraServiceQuestionRepository;
use App\Repositories\Interfaces\IExtraServiceQuestionValueRepository;
use App\Repositories\Interfaces\IExtraServiceStepBodesRepository;
use App\Repositories\Interfaces\IExtraServiceStepRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ExtraServiceStepRepository extends BaseRepository implements IExtraServiceStepRepository
{
  const baseField = [
    'extra_services_step_headers.*'
  ];
  private IExtraServiceQuestionRepository $extraServiceQuestionRepository;
  private IExtraServiceStepBodesRepository $extraServiceStepBodesRepository;
  private IExtraServiceDocumentsRepository $extraServiceDocumentsRepository;
  private IExtraServiceQuestionValueRepository $extraServiceQuestionValueRepository;
  private IExtraServiceQuestionMapRepository $extraServiceQuestionMapRepository;

  public function __construct(
    ExtraServicesStepHeaders             $model,
    IExtraServiceQuestionRepository      $extraServiceQuestionRepository,
    IExtraServiceStepBodesRepository     $extraServiceStepBodesRepository,
    IExtraServiceDocumentsRepository     $extraServiceDocumentsRepository,
    IExtraServiceQuestionValueRepository $extraServiceQuestionValueRepository,
    IExtraServiceQuestionMapRepository $extraServiceQuestionMapRepository
  )
  {
    parent::__construct($model);
    $this->extraServiceQuestionRepository = $extraServiceQuestionRepository;
    $this->extraServiceStepBodesRepository = $extraServiceStepBodesRepository;
    $this->extraServiceDocumentsRepository = $extraServiceDocumentsRepository;
    $this->extraServiceQuestionValueRepository = $extraServiceQuestionValueRepository;
    $this->extraServiceQuestionMapRepository = $extraServiceQuestionMapRepository;
  }

  public function getList($extraServicesQuestionValuesCodeList): Collection
  {
    //1 получить Question list
//    $questionList = $this->extraServiceQuestionRepository->getQuestionListByQuestionValueCode($extraServicesQuestionValuesCodeList);
    $questionValues = $this->extraServiceQuestionValueRepository->getByCode($extraServicesQuestionValuesCodeList);
    //2 получить stepHeaders через questionMap
    $questionValuesIdList = $questionValues->pluck('id');
    $stepHeaderQuery = $this->query()
      ->whereHas('questionMap', function ($q) use ($questionValuesIdList) {
        $q->whereIn('extra_services_question_maps.extra_service_question_value_id', $questionValuesIdList);
      });
    TranslationDal::generateQuery($this->model->getTable(), $stepHeaderQuery, self::baseField, true);
    $stepHeaderList = $stepHeaderQuery->orderBy('order')->get();

    //3 получить stepBodes
    $stepHeaderIdList = $stepHeaderList->pluck('id');
    $stepBodesList = $this->extraServiceStepBodesRepository->getBodyListByHeadId($stepHeaderIdList);

    //4 получить список документов
    foreach ($stepBodesList as $stepBody){
      $stepBody->document_list = $this->extraServiceDocumentsRepository->getDocumentByQuestionValuesAndStepBody($questionValuesIdList, $stepBody->id);
    }

    //5 получить стоимости
    $questionValuesMapList = $this->extraServiceQuestionMapRepository->getListByQuestionValueIdList($questionValuesIdList);

    foreach ($stepHeaderList as $stepHeader) {
      $questionValuesMap = $questionValuesMapList->where('extra_services_step_header_id', '=', $stepHeader->id)->first();
      $stepHeader->step_body_list = $stepBodesList->where('extra_services_step_header_id', '=', $stepHeader->id);
      $stepHeader->totalDay = $stepHeader->step_body_list->sum('dayCount');
      $stepHeader->cost = $questionValues->where('id', '=', $questionValuesMap->id)->sum('cost');
    }

    return $stepHeaderList;
  }

    public function getListByIdList($serviceStepHeaderIdList): Collection
    {
      $stepHeaderQuery = $this->query()->whereIn('id', $serviceStepHeaderIdList);
      TranslationDal::generateQuery($this->model->getTable(), $stepHeaderQuery, self::baseField, true);
      $stepHeaderList = $stepHeaderQuery->orderBy('order')->get();

      $questionValuesMapList = $this->extraServiceQuestionMapRepository->getListByStepHeaderIdList($serviceStepHeaderIdList);
      $questionValuesIdList = $questionValuesMapList->pluck('extra_service_question_value_id');
      $questionValues = $this->extraServiceQuestionValueRepository->getByQuestionIdList($questionValuesIdList);

      $stepHeaderIdList = $stepHeaderList->pluck('id');
      $stepBodesList = $this->extraServiceStepBodesRepository->getBodyListByHeadId($stepHeaderIdList);

      foreach ($stepHeaderList as $stepHeader) {
        $questionValuesMap = $questionValuesMapList->where('extra_services_step_header_id', '=', $stepHeader->id)->first();

        $stepHeader->step_body_list = $stepBodesList->where('extra_services_step_header_id', '=', $stepHeader->id);
        $stepHeader->totalDay = $stepHeader->step_body_list->sum('dayCount');
        $stepHeader->cost = $questionValues->where('id', '=', $questionValuesMap->id)->sum('cost');
      }

      return $stepHeaderList;
    }
}
