<?php

namespace App\Data\Notify\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Notify\Model\EmailJournal
 *
 * @property int $id
 * @property string $planed_send_date
 * @property string|null $message_content
 * @property string $recipients
 * @property string $subject
 * @property string|null $actual_send_date
 * @property string $create_date
 * @property int $created_by
 * @property int $email_notify_type_id
 * @property string|null $send_status_message
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\EmailJournal whereActualSendDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\EmailJournal whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\EmailJournal whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\EmailJournal whereEmailNotifyTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\EmailJournal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\EmailJournal whereMessageContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\EmailJournal wherePlanedSendDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\EmailJournal whereRecipients($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\EmailJournal whereSendStatusMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\EmailJournal whereSubject($value)
 * @mixin \Eloquent
 */
class EmailJournal extends Model
{
    protected $table = 'email_journal';

    public $timestamps = false;

    protected $fillable = [
        'planed_send_date',
        'message_content',
        'recipients',
        'subject',
        'actual_send_date',
        'send_status_message',
        'email_notify_type_id',
        'create_date',
        'created_by'
    ];

    protected $guarded = ['id'];

    public function attachments()
    {
        return $this->hasMany(EmailAttachment::class, 'email_journal_id', 'id');
    }
}
