<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;

interface IExtraServiceQuestionValueRepository extends IRepository
{
  public function getByQuestion($extraServiceQuestionId): Collection;

  public function getByQuestionIdList($extraServiceQuestionIdList): Collection;

  public function getByCode($extraServiceQuestionCodeList): Collection;

}
