<?php

namespace App\Data\Service\Model;

use Illuminate\Database\Eloquent\Model;


class Country extends Model
{
    protected $table = 'country';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'is_visible'
    ];
    protected $guarded = ['id'];
}
