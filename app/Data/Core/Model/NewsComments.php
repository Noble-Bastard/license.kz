<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\NewsComments
 *
 * @property int id
 * @property string create_date
 * @property int news_id
 * @property string comment
 * @property int parent_comment_id
 * @property int level
 * @property int user_id
 *
 * @mixin \Eloquent
 */
class NewsComments extends Model
{
    protected $table = 'news_comments';

    public $timestamps = false;

    protected $fillable = [
        'news_id',
        'parent_comment_id',
        'comment',
        'create_date',
        'level',
        'user_id'
    ];

    protected $guarded = ['id'];

    public function author()
    {
        return $this->hasOne('App\Data\Core\Model\Profile','id','user_id');
    }

    public function news()
    {
        return $this->hasOne('App\Data\Core\Model\News','id','news_id');
    }

    public function answerList()
    {
        return $this->hasMany('App\Data\Core\Model\NewsComments','parent_comment_id','id');
    }
}
