<?php

namespace App\Data\Event\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Event\Model\EventType
 *
 * @property int $id
 * @property string $name
 * @mixin \Eloquent
 */

class EventType extends Model
{
    protected $table = 'event_type';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $guarded = ['id'];
}
