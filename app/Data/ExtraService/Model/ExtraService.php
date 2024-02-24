<?php

namespace App\Data\ExtraService\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ExtraService extends Model
{
  use SoftDeletes;

  protected $table = 'extra_services';

  public $timestamps = false;

  protected $fillable = [
    'code',
    'name',
    'description',
    'day_minimum',
    'cost_minimum'
  ];

  protected $guarded = ['id'];

  public function usefulInformations()
  {
    return $this->hasMany('App\Data\ExtraService\Model\ExtraServiceUsefulInformation', 'extra_service_id', 'id');
  }
}
