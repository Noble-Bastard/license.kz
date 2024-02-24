<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;


class NewsActivityType extends Model
{
    protected $table = 'news_activity_type';

    public $timestamps = false;

    protected $guarded = [
        'name',
    ];
}
