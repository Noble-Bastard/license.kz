<?php

namespace App\Data\ExtraService\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtraServiceQuestionValue extends Model
{
  use SoftDeletes;

  protected $table = 'extra_service_question_values';

  public $timestamps = false;

  protected $fillable = [
    'extra_service_question_id',
    'code',
    'value',
    'cost',
    'order'
  ];

  protected $guarded = ['id'];
}
