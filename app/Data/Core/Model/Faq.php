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
class Faq extends Model
{
    protected $table = 'faq';

    public $timestamps = false;

    protected $fillable = [
        'question',
        'answer',
        'name',
        'email',
        'phone',
        'is_moderate'
    ];

    protected $guarded = ['id'];
}
