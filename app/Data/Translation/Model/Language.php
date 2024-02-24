<?php

namespace App\Data\Translation\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Data\Translation\Model\Translation
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @mixin \Eloquent
 */
class Language extends Model
{
    protected $table = 'language';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name'
    ];

    protected $guarded = ['id'];

}
