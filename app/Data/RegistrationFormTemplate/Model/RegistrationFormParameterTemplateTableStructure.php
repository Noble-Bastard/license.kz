<?php

namespace App\Data\RegistrationFormTemplate\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateTableStructure
 *
 * @property int $id
 * @property int $registration_form_parameter_template_table_id
 * @property int $column_parameter_template_id
 * @mixin \Eloquent
 */
class RegistrationFormParameterTemplateTableStructure extends Model
{
    protected $table = 'registration_form_parameter_template_table_structure';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'registration_form_parameter_template_table_id',
        'column_parameter_template_id'
    ];
    protected $guarded = ['id'];


    public function registrationFormParameterTemplateTable()
    {
        return $this->hasOne('App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateTable','id','registration_form_parameter_template_table_id');
    }

    public function columnParameterTemplate()
    {
        return $this->hasOne('App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplate','id','column_parameter_template_id');
    }
}
