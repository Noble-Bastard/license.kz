<?php

namespace App\Data\ServiceJournal\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\ServiceJournal\Model\ServiceJournalMessageExt
 *
 * @property int $id
 * @property int $service_journal_id
 * @property string|null $service_journal_no
 * @property int $message_id
 * @property string|null $message_caption
 * @property string|null $message_create_date
 * @property \App\Data\Notify\Model\Messages $message
 * @property string $create_date
 * @property int $created_by
 * @property string|null $created_by_full_name
 * @property int|null $created_by_role_id
 * @property string|null $created_by_role_name
 * @property-read \App\User $createdBy
 * @property-read \App\Data\ServiceJournal\Model\ServiceJournal $serviceJournal
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageExt whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageExt whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageExt whereCreatedByFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageExt whereCreatedByRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageExt whereCreatedByRoleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageExt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageExt whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageExt whereMessageCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageExt whereMessageCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageExt whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageExt whereServiceJournalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\ServiceJournal\Model\ServiceJournalMessageExt whereServiceJournalNo($value)
 * @mixin \Eloquent
 */
class ServiceJournalMessageExt extends Model
{
    protected $table = 'service_journal_message_ext';
    public $timestamps = false;

    protected $fillable = [
        'service_journal_id',
        'service_journal_no',
        'message_id',
        'message_caption',
        'message_create_date',
        'message',
        'create_date',
        'created_by',
        'created_by_full_name',
        'created_by_role_id',
        'created_by_role_name'
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
        return $this->hasOne('App\User','id', 'created_by')->with('profile');
    }
}
