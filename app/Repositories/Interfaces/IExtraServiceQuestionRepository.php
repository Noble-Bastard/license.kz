<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;

interface IExtraServiceQuestionRepository extends IRepository
{
  public function getByExtraService($extraServiceId): Collection;

  public function getQuestionListByQuestionValueCode($extraServiceQuestionValueCodeList): Collection;
}
