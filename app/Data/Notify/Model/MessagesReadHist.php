<?php

namespace App\Data\Notify\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Notify\Model\MessagesReadHist
 *
 * @property int $id
 * @property int $message_id
 * @property int $read_by
 * @property string $read_date
 * @property-read \App\Data\Notify\Model\Messages $message
 * @property-read \App\User $readBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\MessagesReadHist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\MessagesReadHist whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\MessagesReadHist whereReadBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\MessagesReadHist whereReadDate($value)
 * @mixin \Eloquent
 */
class MessagesReadHist extends Model
{
    protected $table = 'messages_read_hist';

    public $timestamps = false;

    protected $fillable = [
        'message_id',
        'read_by',
        'read_date'
    ];

    protected $guarded = ['id'];

    public function message()
    {
        return $this->hasOne('App\Data\Notify\Model\Messages','id','message_id');
    }

    public function readBy()
    {
        return $this->hasOne('App\User','id', 'read_by');
    }

}
