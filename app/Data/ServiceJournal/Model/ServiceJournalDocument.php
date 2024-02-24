<?php

namespace App\Data\ServiceJournal\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\ServiceJournal\Model\ServiceJournalDocument
 *
 * @property int $id
 * @property int $service_journal_id
 * @property int $document_id
 * @property string $create_date
 * @property int $created_by
 * @property string $description
 * @property-read \App\User $createdBy
 * @property-read \App\Data\Document\Model\Document $document
 * @property-read \App\Data\ServiceJournal\Model\ServiceJournal $serviceJournal
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalDocument whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalDocument whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalDocument whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalDocument whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalDocument whereServiceJournalId($value)
 * @mixin \Eloquent
 */
class ServiceJournalDocument extends Model
{
    protected $table = 'service_journal_document';
    public $timestamps = false;

    protected $fillable = [
        'service_journal_id',
        'document_id',
        'create_date',
        'created_by',
        'description'
    ];
    protected $guarded = ['id'];

    public function serviceJournal()
    {
        return $this->hasOne('App\Data\ServiceJournal\Model\ServiceJournal','id','service_journal_id');
    }

    public function document()
    {
        return $this->hasOne('App\Data\Document\Model\Document','id','document_id');
    }

    public function createdBy()
    {
        return $this->hasOne('App\User','id', 'created_by');
    }

}
