<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\Setting
 *
 * @property int $id
 * @property int $aps_week_working_day_id
 * @property int|null $client_request_response_time
 * @property int|null $default_language_id
 * @property int $areement_counter_type_id
 * @mixin \Eloquent
 */
class Setting extends Model
{
    protected $table = 'aps_setting';

    public $timestamps = false;

    protected $guarded = [
        'aps_week_working_day_id',
        'client_request_response_time',
        'default_language_id',
        'areement_counter_type_id',
        'invoice_counter_type_id',
        'payment_counter_type_id',
        'consultation_service_cost',
        'client_check_cost',
        'mrp',
        'base_currency_id',
        'prepayment_cost'
    ];

    public function weekWorkingDay()
    {
        return $this->hasOne('App\Data\WorkingCalendar\Model\WeekWorkingDay','id','aps_week_working_day_id');
    }
}
