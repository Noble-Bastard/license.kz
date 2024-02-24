<?php

namespace App\Data\ServiceJournal\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\ServiceJournal\Model\ServiceJournalMessageReadHistExt
 *
 * @property int $id
 * @property int $service_journal_id
 * @property int|null $client_id
 * @property int|null $manager_id
 * @property int $message_id
 * @property string|null $message_create_date
 * @property string|null $message_client_read_date
 * @property int|null $message_client_read_by
 * @property string|null $message_manager_read_date
 * @property int|null $message_manager_read_by
 * @property-read \App\Data\Notify\Model\Messages $message
 * @property-read \App\User $readByClient
 * @property-read \App\User $readByManager
 * @property-read \App\Data\ServiceJournal\Model\ServiceJournal $serviceJournal
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageReadHistExt whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageReadHistExt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageReadHistExt whereManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageReadHistExt whereMessageClientReadBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageReadHistExt whereMessageClientReadDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageReadHistExt whereMessageCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageReadHistExt whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageReadHistExt whereMessageManagerReadBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageReadHistExt whereMessageManagerReadDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageReadHistExt whereServiceJournalId($value)
 * @mixin \Eloquent
 */
class ServiceJournalMessageReadHistExt extends Model
{
    protected $table = 'service_journal_message_read_hist_ext';
    public $timestamps = false;

    protected $fillable = [
        'service_journal_id',
        'message_id',
        'message_create_date',
        'message_client_read_date',
        'message_client_read_by',
        'message_manager_read_date',
        'message_manager_read_by'
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

    public function readByClient()
    {
        return $this->hasOne('App\User','id', 'message_client_read_by');
    }

    public function readByManager()
    {
        return $this->hasOne('App\User','id', 'message_manager_read_by');
    }
}
