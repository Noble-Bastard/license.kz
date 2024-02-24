<?php

namespace App\Repositories;

use App\Data\ExtraService\Model\ExtraService;
use App\Data\ExtraService\Model\ExtraServiceQuestion;
use App\Data\Translation\Dal\TranslationDal;
use App\Repositories\Interfaces\IExtraServiceQuestionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ExtraServiceQuestionRepository extends BaseRepository implements IExtraServiceQuestionRepository
{
  const baseField = [
    'extra_service_questions.*'
  ];

  public function __construct(ExtraServiceQuestion $model)
  {
    parent::__construct($model);
  }


    public function getByExtraService($extraServiceId): Collection
    {
      $query = $this->query()->where('extra_service_id', $extraServiceId);
      TranslationDal::generateQuery($this->model->getTable(), $query, self::baseField, true);

      return $query->orderBy('order')->get();
    }

  public function getQuestionListByQuestionValueCode($extraServiceQuestionValueCodeList): Collection
  {
    return $this->query()
      ->join('extra_service_question_values', function($join) use($extraServiceQuestionValueCodeList) {
        $join->on('extra_service_questions.id', '=', 'extra_service_question_values.extra_service_question_id')
          ->whereIn('extra_service_question_values.code', $extraServiceQuestionValueCodeList);
      })->get();
  }


}
