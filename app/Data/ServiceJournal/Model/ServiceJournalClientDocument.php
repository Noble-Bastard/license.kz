<?php

namespace App\Data\ServiceJournal\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\ServiceJournal\Model\ServiceJournalClientDocument
 *
 * @property int $id
 * @property int $service_journal_id
 * @property int|null $service_journal_step_id
 * @property int $document_id
 * @property string $create_date
 * @property string $description
 * @property-read \App\Data\Document\Model\Document $document
 * @property-read \App\Data\ServiceJournal\Model\ServiceJournal $serviceJournal
 * @property-read \App\Data\ServiceJournal\Model\ServiceJournalStep $serviceJournalStep
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalClientDocument whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalClientDocument whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalClientDocument whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalClientDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalClientDocument whereServiceJournalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalClientDocument whereServiceJournalStepId($value)
 * @mixin \Eloquent
 */
class ServiceJournalClientDocument extends Model
{
    protected $table = 'service_journal_client_document';
    public $timestamps = false;

    protected $fillable = [
        'service_journal_id',
        'service_journal_step_id',
        'document_id',
        'create_date',
        'description',
        'is_active'
    ];
    protected $guarded = ['id'];

    public function serviceJournal()
    {
        return $this->hasOne('App\Data\ServiceJournal\Model\ServiceJournal','id','service_journal_id');
    }

    public function serviceJournalStep()
    {
        return $this->hasOne('App\Data\ServiceJournal\Model\ServiceJournalStep','id','service_journal_step_id');
    }

    public function document()
    {
        return $this->hasOne('App\Data\Document\Model\Document','id','document_id');
    }

}
