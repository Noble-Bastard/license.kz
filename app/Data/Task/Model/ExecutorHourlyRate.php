<?php

namespace App\Data\Task\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Task\Model\ExecutorHourlyRate
 *
 * @property int $id
 * @property int $executor_id
 * @property float $hourly_rate
 * @property string $create_date
 * @property int $created_by
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\ExecutorHourlyRate whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\ExecutorHourlyRate whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\ExecutorHourlyRate whereExecutorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\ExecutorHourlyRate whereHourlyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\ExecutorHourlyRate whereId($value)
 *
 * @mixin \Eloquent
 */
class ExecutorHourlyRate extends Model
{
    protected $table = 'executor_hourly_rate';
    public $timestamps = false;

    protected $fillable = [
        'executor_id',
        'hourly_rate',
        'create_date',
        'created_by'
    ];
    protected $guarded = ['id'];
}
