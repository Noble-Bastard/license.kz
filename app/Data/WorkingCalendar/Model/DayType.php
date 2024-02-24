<?php

namespace App\Data\WorkingCalendar\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\WorkingCalendar\Model\DayType
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\WorkingCalendar\Model\DayType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\WorkingCalendar\Model\DayType whereName($value)
 * @mixin \Eloquent
 */
class DayType extends Model
{
    protected $table = 'aps_day_type';

    public $timestamps = false;

    protected $fillable = ['name'];

    protected $guarded = ['id'];
}
