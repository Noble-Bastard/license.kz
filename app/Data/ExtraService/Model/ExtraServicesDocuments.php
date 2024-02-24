<?php

namespace App\Data\ExtraService\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtraServicesDocuments extends Model
{
  use SoftDeletes;

  protected $table = 'extra_services_documents';

  public $timestamps = false;

  protected $fillable = [
    'name'
  ];

  protected $guarded = ['id'];
}
