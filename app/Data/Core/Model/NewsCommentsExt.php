<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\NewsCommentsExt
 *
 * @property int $id
 * @property string $create_date
 * @property int $news_id
 * @property string $comment
 * @property int $parent_comment_id
 * @property int $level
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\NewsComments whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\NewsComments whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\NewsComments whereHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\NewsComments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\NewsComments whereIsActual($value)
 * @mixin \Eloquent
 */
class NewsCommentsExt extends Model
{
    protected $table = 'news_comments_ext';

    public $timestamps = false;

    protected $fillable = [
        'news_id',
        'parent_comment_id',
        'comment',
        'create_date',
        'level',
        'user_id',
        'name'
    ];

    protected $guarded = ['id'];
}
