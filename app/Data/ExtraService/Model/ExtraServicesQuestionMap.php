<?php

namespace App\Data\ExtraService\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtraServicesQuestionMap extends Model
{
  use SoftDeletes;

  protected $table = 'extra_services_question_maps';

  public $timestamps = false;

  protected $fillable = [
    'extra_service_question_value_id',
    'extra_services_step_header_id'
  ];

  protected $guarded = ['id'];
}
