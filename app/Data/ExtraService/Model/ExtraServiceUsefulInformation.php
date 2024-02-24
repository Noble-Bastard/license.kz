<?php

namespace App\Data\ExtraService\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ExtraServiceUsefulInformation extends Model
{
  use SoftDeletes;

  protected $table = 'extra_services_useful_information';

  public $timestamps = false;

  protected $fillable = [
    'extra_service_id',
    'order_no',
    'name',
    'short_description',
    'description',
    'btn_name',
    'file_path'
  ];

  protected $guarded = ['id'];
}
