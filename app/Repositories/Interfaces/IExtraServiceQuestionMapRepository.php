<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;

interface IExtraServiceQuestionMapRepository extends IRepository
{
  public function getListByQuestionValueIdList($extraServiceQuestionValueIdList): Collection;

  public function getListByStepHeaderIdList($extraServiceStepHeaderIdList): Collection;
}
