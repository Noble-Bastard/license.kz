<?php

namespace App\Data\RegistrationFormTemplate\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateTable
 *
 * @property int $id
 * @property int $registration_form_parameter_template_id
 * @property string $table_caption
 * @mixin \Eloquent
 */
class RegistrationFormParameterTemplateTable extends Model
{
    protected $table = 'registration_form_parameter_template_table';
    public $timestamps = false;

    protected $fillable = [
        'registration_form_parameter_template_id',
        'table_caption'
    ];
    protected $guarded = ['id'];


    public function registrationFormParameterTemplate()
    {
        return $this->hasOne('App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplate','id','registration_form_parameter_template_id');
    }
}
