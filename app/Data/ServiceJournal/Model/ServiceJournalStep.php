<?php

namespace App\Data\ServiceJournal\Model;

use App\Data\Service\Dal\ServiceRequiredDocumentDal;
use App\Data\Service\Dal\ServiceStepRequiredDocumentDal;
use App\Data\Service\Model\Service;
use App\Data\Service\Model\ServiceStep;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\ServiceJournal\Model\ServiceJournalStep
 *
 * @property int $id
 * @property int $service_journal_id
 * @property int $service_step_id
 * @property string $service_step_no
 * @property int $is_completed
 * @property string|null $execution_start_date
 * @property string|null $completion_date
 * @property-read \App\Data\ServiceJournal\Model\ServiceJournal $serviceJournal
 * @property-read \App\Data\Service\Model\ServiceStep $serviceStep
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalStep whereCompletionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalStep whereExecutionStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalStep whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalStep whereIsCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalStep whereServiceJournalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalStep whereServiceStepId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalStep whereServiceStepNo($value)
 * @mixin \Eloquent
 */
class ServiceJournalStep extends Model
{
    protected $table = 'service_journal_step';
    public $timestamps = false;

    protected $fillable = [
        'service_journal_id',
        'service_step_id',
        'service_step_no',
        'is_completed',
        'execution_start_date',
        'completion_date'
    ];
    protected $guarded = ['id'];

    public function serviceJournal()
    {
        return $this->hasOne('App\Data\ServiceJournal\Model\ServiceJournal','id','service_journal_id');
    }

    public function serviceStep()
    {
        return $this->hasOne(ServiceStep::class,'id','service_step_id');
    }

    public function requiredDocumentByStep()
    {
        return (new ServiceStepRequiredDocumentDal())->getByServiceJournalAndStep($this->service_journal_id, $this->service_step_id);
    }

    public function clientAttachedDocument()
    {
        return $this->hasMany(ServiceJournalClientDocument::class,'service_journal_step_id','id')->where('is_active', 1);
    }
}
