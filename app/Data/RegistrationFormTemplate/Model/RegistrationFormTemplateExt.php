<?php

namespace App\Data\RegistrationFormTemplate\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplateExt
 *
 * @property int $id
 * @property int $counter_type_id
 * @property string|null $counter_type_name
 * @property string $name
 * @property-read \App\Data\Core\Model\CounterType $counterType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplateExt whereCounterTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplateExt whereCounterTypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplateExt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplateExt whereName($value)
 * @mixin \Eloquent
 */
class RegistrationFormTemplateExt extends Model
{
    protected $table = 'registration_form_template_ext';
    public $timestamps = false;

    protected $fillable = [
        'counter_type_id',
        'counter_type_name',
        'name'
    ];
    protected $guarded = ['id'];

    public function counterType()
    {
        return $this->hasOne('App\Data\Core\Model\CounterType','id','counter_type_id');
    }

}
