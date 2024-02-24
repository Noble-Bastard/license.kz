<?php

namespace App\Data\ServiceJournal\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ServiceJournalStepExt
 *
 * @package App\Data\ServiceJournal\Model
 * @property-read int id
 * @property-read int service_journal_id
 * @property-read string service_journal_service_no
 * @property-read int service_step_id
 * @property-read string service_step_description
 * @property-read string service_step_no
 * @property-read bool is_completed
 * @property-read \DateTime execution_start_date
 * @property-read \DateTime completion_date
 * @property-read int execution_time_plan
 * @property-read int task_id
 * @property-read int execution_work_day_cnt
 * @property-read \App\Data\ServiceJournal\Model\ServiceJournal $serviceJournal
 * @property-read \App\Data\Service\Model\ServiceStep $serviceStep
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalStepExt whereCompletionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalStepExt whereExecutionStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalStepExt whereExecutionTimePlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalStepExt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalStepExt whereIsCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalStepExt whereServiceJournalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalStepExt whereServiceJournalServiceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalStepExt whereServiceStepDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalStepExt whereServiceStepId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalStepExt whereServiceStepNo($value)
 * @mixin \Eloquent
 */



class ServiceJournalStepExt extends Model
{
    protected $table = 'service_journal_step_ext';
    public $timestamps = false;

    protected $fillable = [
        'service_journal_id',
        'service_journal_service_no',
        'service_step_id',
        'service_step_description',
        'service_step_no',
        'is_completed',
        'execution_start_date',
        'completion_date',
        'execution_time_plan',
        'task_id',
        'execution_work_day_cnt'
    ];
    protected $guarded = ['id'];

    public function serviceJournal()
    {
        return $this->hasOne('App\Data\ServiceJournal\Model\ServiceJournal','id','service_journal_id');
    }

    public function serviceStep()
    {
        return $this->hasOne('App\Data\Service\Model\ServiceStep','id','service_step_id');
    }
}
