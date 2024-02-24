<?php

namespace App\Data\ExtraService\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ExtraServiceQuestion extends Model
{
  use SoftDeletes;

  protected $table = 'extra_service_questions';

  public $timestamps = false;

  protected $fillable = [
    'extra_service_id',
    'value',
    'order'
  ];

  protected $guarded = ['id'];
}
