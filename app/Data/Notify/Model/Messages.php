<?php
/**
 * Created by PhpStorm.
 * User: r.biewald
 * Date: 02.05.2018
 * Time: 20:22
 */
namespace App\Data\Notify\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Notify\Model\Messages
 *
 * @property int $id
 * @property string|null $caption
 * @property string $message
 * @property int|null $email_journal_id
 * @property string $create_date
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\Messages whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\Messages whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\Messages whereEmailJournalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\Messages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Notify\Model\Messages whereMessage($value)
 * @mixin \Eloquent
 */
class Messages extends Model
{
    protected $table = 'messages';

    public $timestamps = false;

    protected $fillable = [
        'caption',
        'message',
        'email_journal_id',
        'create_date'
    ];

    protected $guarded = ['id'];
}