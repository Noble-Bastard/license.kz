<?php

namespace App\Data\RegistrationFormTemplate\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Data\RegistrationFormTemplate\Model\OptionsetType
 *
 * @property int $id
 * @property int $optionset_type_id
 * @property String $optionset_value
 * @property boolean $is_default
 * @mixin \Eloquent
 */
class OptionsetValueTemplate extends Model
{
    protected $table = 'optionset_value_template';
    public $timestamps = false;

    protected $fillable = [
        'optionset_type_id',
        'optionset_value',
        'optionset_id',
        'is_default',
    ];
    protected $guarded = ['id'];
}
