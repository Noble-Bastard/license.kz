<?php

namespace App\Repositories;

use App\Data\ExtraService\Model\ExtraServiceQuestion;
use App\Data\ExtraService\Model\ExtraServiceQuestionValue;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ExtraServiceQuestionValueRepository extends BaseRepository implements Interfaces\IExtraServiceQuestionValueRepository
{
  const baseField = [
    'extra_service_questions.*'
  ];

  public function __construct(ExtraServiceQuestionValue $model)
  {
    parent::__construct($model);
  }

  public function getByQuestion($extraServiceQuestionId): Collection
  {
    $query = $this->query()->where('extra_service_question_id', $extraServiceQuestionId);
    TranslationDal::generateQuery($this->model->getTable(), $query, self::baseField, true);

    return $query->orderBy('order')->get();
  }

  public function getByQuestionIdList($extraServiceQuestionIdList): Collection
  {
    $query = $this->query()->whereIn('extra_service_question_id', $extraServiceQuestionIdList);
    TranslationDal::generateQuery($this->model->getTable(), $query, self::baseField, true);

    return $query->orderBy('order')->get();
  }

  public function getByCode($extraServiceQuestionCodeList): Collection
  {
    $query = $this->query()->whereIn('code', $extraServiceQuestionCodeList);
    TranslationDal::generateQuery($this->model->getTable(), $query, self::baseField, true);

    return $query->orderBy('order')->get();
  }
}
