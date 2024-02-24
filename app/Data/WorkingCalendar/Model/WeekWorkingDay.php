<?php

namespace App\Data\WorkingCalendar\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\WorkingCalendar\Model\WeekWorkingDay
 *
 * @property int $id
 * @property int $sun
 * @property int $mon
 * @property int $tue
 * @property int $wed
 * @property int $thu
 * @property int $fri
 * @property int $sat
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\WorkingCalendar\Model\WeekWorkingDay whereFri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\WorkingCalendar\Model\WeekWorkingDay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\WorkingCalendar\Model\WeekWorkingDay whereMon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\WorkingCalendar\Model\WeekWorkingDay whereSat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\WorkingCalendar\Model\WeekWorkingDay whereSun($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\WorkingCalendar\Model\WeekWorkingDay whereThu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\WorkingCalendar\Model\WeekWorkingDay whereTue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\WorkingCalendar\Model\WeekWorkingDay whereWed($value)
 * @mixin \Eloquent
 */
class WeekWorkingDay extends Model
{
    protected $table = 'aps_week_working_day';

    public $timestamps = false;

    protected $fillable = ['sun', 'mon', 'tue','wed', 'thu', 'fri', 'sat' ];

    protected $guarded = ['id'];
}
