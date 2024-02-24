<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

class NewsContentType extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    protected $guarded = [
        'id'
    ];
}
