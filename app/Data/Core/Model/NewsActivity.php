<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;


class NewsActivity extends Model
{
    protected $table = 'news_activity';

    public $timestamps = false;

    protected $guarded = [
        'ip',
        'news_id',
        'news_activity_type_id',
    ];

    public function activityType()
    {
        return $this->belongsTo(NewsActivityType::class);
    }
}
