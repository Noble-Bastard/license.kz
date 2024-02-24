<?php

namespace App\Data\WorkingCalendar\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\WorkingCalendar\Model\WorkingDay
 *
 * @property int $id
 * @property int $aps_day_type_id
 * @property string $start_date
 * @property string $end_date
 * @property string $decsription
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\WorkingCalendar\Model\WorkingDay whereApsDayTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\WorkingCalendar\Model\WorkingDay whereDecsription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\WorkingCalendar\Model\WorkingDay whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\WorkingCalendar\Model\WorkingDay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\WorkingCalendar\Model\WorkingDay whereStartDate($value)
 * @mixin \Eloquent
 * @property-read \App\Data\WorkingCalendar\Model\DayType $dayType
 */
class WorkingDay extends Model
{
    protected $table = 'aps_working_day';

    public $timestamps = false;

    protected $fillable = ['aps_day_type_id', 'start_date', 'end_date','decsription'];

    protected $guarded = ['id'];

    public function dayType()
    {
        return $this->hasOne('App\Data\WorkingCalendar\Model\DayType','id','aps_day_type_id');
    }

}
