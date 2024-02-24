<?php

namespace App\Data\ExtraService\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtraServicesStepHeaders extends Model
{
  use SoftDeletes;

  protected $table = 'extra_services_step_headers';

  public $timestamps = false;

  protected $fillable = [
    'name',
    'order',
    'service_id'
  ];

  protected $guarded = ['id'];

  public function questionMap()
  {
    return $this->hasMany('App\Data\ExtraService\Model\ExtraServicesQuestionMap', 'extra_services_step_header_id', 'id');
  }
}
