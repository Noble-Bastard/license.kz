<?php

namespace App\Repositories;

use App\Data\ExtraService\Model\ExtraServicesQuestionMap;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ExtraServiceQuestionMapRepository extends BaseRepository implements Interfaces\IExtraServiceQuestionMapRepository
{
  const baseField = [
    'extra_services_question_maps.*'
  ];

  public function __construct(ExtraServicesQuestionMap $model)
  {
    parent::__construct($model);
  }

  public function getListByQuestionValueIdList($extraServiceQuestionValueIdList): Collection
  {
    return $this->query()->whereIn('extra_service_question_value_id', $extraServiceQuestionValueIdList)->get();
  }

  public function getListByStepHeaderIdList($extraServiceStepHeaderIdList): Collection
  {
    return $this->query()->whereIn('extra_services_step_header_id', $extraServiceStepHeaderIdList)->get();
  }
}
