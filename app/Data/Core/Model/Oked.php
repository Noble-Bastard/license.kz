<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * App\Data\Core\Model\News
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @mixin \Eloquent
 */
class Oked extends Model
{
    protected $table = 'okeds';

    public $timestamps = false;

    protected $fillable = [
        'code',
        'description',
        'note'
    ];

    protected $guarded = ['id'];
}
