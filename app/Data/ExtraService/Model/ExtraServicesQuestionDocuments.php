<?php

namespace App\Data\ExtraService\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtraServicesQuestionDocuments extends Model
{
  use SoftDeletes;

  protected $table = 'extra_services_question_documents';

  public $timestamps = false;

  protected $fillable = [
    'extra_services_document_id',
    'extra_service_question_value_id',
    'extra_services_step_body_id',
  ];

  protected $guarded = ['id'];
}
