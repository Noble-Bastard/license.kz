<?php

namespace App\Data\ExtraService\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtraServicesStepBodes extends Model
{
  use SoftDeletes;

  protected $table = 'extra_services_step_bodes';

  public $timestamps = false;

  protected $fillable = [
    'extra_services_step_header_id',
    'name',
    'dayCount',
    'result',
    'order',
    'service_step_id'
  ];

  protected $guarded = ['id'];
}
