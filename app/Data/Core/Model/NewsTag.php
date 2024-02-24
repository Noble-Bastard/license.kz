<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\News
 *
 * @property int $id
 * @property string $name
 * @property int $news_content_type_id
 * @property int $language_id
 * @mixin \Eloquent
 */
class NewsTag extends Model
{
    protected $table = 'news_tags';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'news_content_type_id',
        'language_id'
    ];

    protected $guarded = ['id'];
}
