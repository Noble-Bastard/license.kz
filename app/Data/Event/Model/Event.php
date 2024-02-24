<?php

namespace App\Data\Event\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Event\Model\Event
 *
 * @property int $id
 * @property string $event_date
 * @property string $name
 * @property string $content
 * @property string $name_en
 * @property string $content_en
 * @property string $city
 * @property string $place
 * @property string $preview_photo
 * @property string $logo_photo
 * @property int $event_type_id

 */
class Event extends Model
{
    protected $table = 'event';
    public $timestamps = false;

    protected $fillable = [
        'event_date',
        'name',
        'name_en',
        'content',
        'content_en',
        'city',
        'place',
        'preview_photo',
        'logo_photo',
        'event_type_id'
    ];

    protected $guarded = ['id'];

    public function eventType()
    {
        return $this->hasOne('App\Data\Event\Model\EventType','id','event_type_id');
    }
}
