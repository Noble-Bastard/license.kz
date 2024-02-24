<?php

namespace App\Data\Subsciption\Model;

use Illuminate\Database\Eloquent\Model;

class EventSubscription extends Model
{
    protected $table = 'event_subscription';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'email',
        'name',
    ];

    protected $casts = [
        'id' => 'string'
    ];
}