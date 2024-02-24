<?php

namespace App\Data\Translation\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Data\Translation\Model\Translation
 *
 * @property int $id
 * @property string $name
 * @mixin \Eloquent
 */
class TranslationEntity extends Model
{
    protected $table = 'translation_entity';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $guarded = ['id'];

}
