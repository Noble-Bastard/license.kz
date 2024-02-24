<?php

namespace App\Data\RegistrationFormTemplate\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationFormTemplate\Model\ParameterGroup
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\ParameterGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\ParameterGroup whereName($value)
 * @mixin \Eloquent
 */
class ParameterGroup extends Model
{
    protected $table = 'parameter_group';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
    protected $guarded = ['id'];
}
