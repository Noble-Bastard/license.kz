<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * App\Data\Core\Model\News
 *
 * @property int $id
 * @property string $create_date
 * @property int $is_actual
 * @property string $header
 * @property string $content
 * @property int $orderNum
 * @property int $country_id
 * @property string $preview_photo

 * @mixin \Eloquent
 */
class News extends Model
{
    protected $table = 'news';

    protected $dates = ['create_date'];

    public $timestamps = false;

    protected $fillable = [
        'create_date',
        'is_actual',
        'header',
        'content',
        'orderNum',
        'country_id',
        'preview_photo',
        'tags',
        'lead',
        'news_content_type_id',
        'language_id'
    ];

    protected $guarded = ['id'];

    public function newsContentType()
    {
        return $this->belongsTo(NewsContentType::class);
    }

    public function comments()
    {
        return $this
                ->hasMany(NewsComments::class,'news_id','id')
                ->orderBy('parent_comment_id', 'asc')
                ->orderBy('create_date', 'desc')
                ;
    }

    public function newsView()
    {
        return $this->hasMany(NewsActivity::class)
            ->where('news_activity_type_id', '=', 1);
    }
    public function newsLike()
    {
        return $this->hasMany(NewsActivity::class)
            ->where('news_activity_type_id', '=', 2);
    }

    public function getThumbnailAttribute()
    {
        $imageUrl = $this->preview_photo;
        $thumbnailUrl = str_replace('images/', 'images/thumbnails/', $imageUrl);
        if(Storage::disk('public')->exists($thumbnailUrl)){
            return $thumbnailUrl;
        }
        return $imageUrl;
    }
}
