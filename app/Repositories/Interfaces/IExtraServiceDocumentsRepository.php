<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;

interface IExtraServiceDocumentsRepository extends IRepository
{
  public function getDocumentByQuestionValuesAndStepBodyList($questionValueIdList, $stepBodyIdList): Collection;
  public function getDocumentByQuestionValuesAndStepBody($questionValueIdList, $stepBodyId): Collection;
}
