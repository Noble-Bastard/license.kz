<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\News
 *
 * @property int $id
 * @property string $name
 * @mixin \Eloquent
 */
class ReviewType extends Model
{
    protected $table = 'review_type';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    protected $guarded = ['id'];
}
