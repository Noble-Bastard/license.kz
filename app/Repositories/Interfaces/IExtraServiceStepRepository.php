<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;

interface IExtraServiceStepRepository extends IRepository
{
  public function getList($extraServicesQuestionValuesCodeList): Collection;
  public function getListByIdList($serviceStepHeaderIdList): Collection;
}
