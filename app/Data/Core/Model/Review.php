<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\News
 *
 * @property int $id
 * @property int review_type_id
 * @property string company_name
 * @property string company_description
 * @property string youtube_url
 * @property string file_path
 * @property boolean is_publish

 * @mixin \Eloquent
 */
class Review extends Model
{
    protected $table = 'review';

    public $timestamps = false;

    protected $fillable = [
        'review_type_id',
        'company_name',
        'company_description',
        'youtube_url',
        'file_path',
        'is_publish',
    ];

    protected $guarded = ['id'];

    public function reviewType()
    {
        return $this->belongsTo(ReviewType::class);
    }
}
