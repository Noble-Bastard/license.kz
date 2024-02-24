<?php

namespace App\Data\Article\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Data\Article\Model\Article
 *
 * @property int $id
 * @property string $content
 * @property int $orderNum
 * @property int|null $article_type
 * @property int $country_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Article\Model\Article whereArticleType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Article\Model\Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Article\Model\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Article\Model\Article whereOrderNum($value)
 * @mixin \Eloquent
 */
class Article extends Model
{
    protected $table = 'article';

    public $timestamps = false;

    protected $fillable = [
        'content',
        'article_type',
        'orderNum',
        'country_id'
    ];

    protected $guarded = ['id'];

    public function type()
    {
        return $this->hasOne(ArticleType::class, 'id', 'article_type');
    }
}
