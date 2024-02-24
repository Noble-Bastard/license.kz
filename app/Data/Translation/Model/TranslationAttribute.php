<?php

namespace App\Data\Translation\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Data\Translation\Model\Translation
 *
 * @property int $id
 * @property int $translation_entity_id
 * @property string $name
 * @mixin \Eloquent
 */
class TranslationAttribute extends Model
{
    protected $table = 'translation_attribute';
    public $timestamps = false;

    protected $fillable = [
        'translation_entity_id',
        'name'
    ];

    protected $guarded = ['id'];

}
