<?php

namespace App\Data\Article\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ArticleType
 *
 * @package App\Data\Article\Model
 * @property int id
 * @property string name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Article\Model\ArticleType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Article\Model\ArticleType whereName($value)
 * @mixin \Eloquent
 */
class ArticleType extends Model
{
    protected $table = 'article_type';

    public $timestamps = false;

    protected $fillable = ['name'];

    protected $guarded = ['id'];
}
