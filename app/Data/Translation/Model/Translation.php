<?php

namespace App\Data\Translation\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Data\Translation\Model\Translation
 *
 * @property int $id
 * @property int $translation_attribute_id
 * @property int $language_id
 * @property int $pk_value
 * @property string $value
 * @mixin \Eloquent
 */
class Translation extends Model
{
    protected $table = 'translation';
    public $timestamps = false;

    protected $fillable = [
        'translation_attribute_id',
        'language_id',
        'pk_value',
        'value'
    ];

    protected $guarded = ['id'];

}
