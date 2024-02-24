<?php

namespace App\Repositories;

use App\Data\ExtraService\Model\ExtraServicesStepBodes;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Database\Eloquent\Collection;

class ExtraServiceStepBodesRepository extends BaseRepository implements Interfaces\IExtraServiceStepBodesRepository
{
  const baseField = [
    'extra_services_step_bodes.*'
  ];

  public function __construct(
    ExtraServicesStepBodes $model
  )
  {
    parent::__construct($model);
  }
  public function getBodyListByHeadId($headIdList): Collection
  {
    $query = $this->query()->whereIn('extra_services_step_header_id', $headIdList);
    TranslationDal::generateQuery($this->model->getTable(), $query, self::baseField, true);

    return $query->orderBy('order')->get();
  }
}
