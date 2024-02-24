<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;

interface IExtraServiceStepBodesRepository extends IRepository
{
  public function getBodyListByHeadId($headIdList): Collection;
}
