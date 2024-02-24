<?php

namespace App\Repositories;

use App\Data\ExtraService\Model\ExtraServicesDocuments;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ExtraServiceDocumentsRepository extends BaseRepository implements Interfaces\IExtraServiceDocumentsRepository
{
  const baseField = [
    'extra_services_documents.*'
  ];

  public function __construct(ExtraServicesDocuments $model)
  {
    parent::__construct($model);
  }
  public function getDocumentByQuestionValuesAndStepBody($questionValueIdList, $stepBodyId): Collection
  {
    return $this->query()
      ->join('extra_services_question_documents', function($join) use($questionValueIdList, $stepBodyId) {
        $join->on('extra_services_documents.id', '=', 'extra_services_question_documents.extra_services_document_id')
          ->whereIn('extra_services_question_documents.extra_service_question_value_id', $questionValueIdList)
          ->where('extra_services_question_documents.extra_services_step_body_id', $stepBodyId);
      })->get();
  }

  public function getDocumentByQuestionValuesAndStepBodyList($questionValueIdList, $stepBodyIdList): Collection
  {
    return $this->query()
      ->join('extra_services_question_documents', function($join) use($questionValueIdList, $stepBodyIdList) {
        $join->on('extra_services_documents.id', '=', 'extra_services_question_documents.extra_services_document_id')
          ->whereIn('extra_services_question_documents.extra_service_question_value_id', $questionValueIdList)
          ->whereIn('extra_services_question_documents.extra_services_step_body_id', $questionValueIdList);
      })->get();
  }
}
