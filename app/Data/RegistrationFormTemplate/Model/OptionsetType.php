<?php

namespace App\Data\RegistrationFormTemplate\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Data\RegistrationFormTemplate\Model\OptionsetType
 *
 * @property int $id
 * @property string $name
 * @mixin \Eloquent
 */
class OptionsetType extends Model
{
    protected $table = 'optionset_type';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
    protected $guarded = ['id'];
}
