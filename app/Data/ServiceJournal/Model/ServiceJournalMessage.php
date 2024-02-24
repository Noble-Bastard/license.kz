<?php

namespace App\Data\ServiceJournal\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\ServiceJournal\Model\ServiceJournalMessage
 *
 * @property int $id
 * @property int $service_journal_id
 * @property int $message_id
 * @property string $create_date
 * @property int $created_by
 * @property-read \App\User $createdBy
 * @property-read \App\Data\Notify\Model\Messages $message
 * @property-read \App\Data\ServiceJournal\Model\ServiceJournal $serviceJournal
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessage whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessage whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessage whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessage whereServiceJournalId($value)
 * @mixin \Eloquent
 */
class ServiceJournalMessage extends Model
{
    protected $table = 'service_journal_message';
    public $timestamps = false;

    protected $fillable = [
        'service_journal_id',
        'message_id',
        'create_date',
        'created_by'
    ];
    protected $guarded = ['id'];

    public function serviceJournal()
    {
        return $this->hasOne('App\Data\ServiceJournal\Model\ServiceJournal','id','service_journal_id');
    }

    public function message()
    {
        return $this->hasOne('App\Data\Notify\Model\Messages','id','message_id');
    }

    public function createdBy()
    {
        return $this->hasOne('App\User','id', 'created_by');
    }
}
