<?php

namespace App\Data\RegistrationFormTemplate\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationFormTemplate\Model\ParameterType
 *
 * @property int $id
 * @property string $name
 * @property string $data_type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\ParameterType whereDataType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\ParameterType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\ParameterType whereName($value)
 * @mixin \Eloquent
 */
class ParameterType extends Model
{
    protected $table = 'parameter_type';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'data_type'
    ];
    protected $guarded = ['id'];


}
