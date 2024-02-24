<?php

namespace App\Data\RegistrationFormTemplate\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateTableStructureExt
 *
 * @property int $id
 * @property int $registration_form_parameter_template_table_id
 * @property int $column_parameter_template_id
 * @property int|null $registration_form_parameter_template_id
 * @property string|null $table_caption
 * @mixin \Eloquent
 */
class RegistrationFormParameterTemplateTableStructureExt extends Model
{
    protected $table = 'registration_form_parameter_template_table_structure_ext';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'registration_form_parameter_template_table_id',
        'column_parameter_template_id',
        'registration_form_parameter_template_id',
        'table_caption'
    ];
    protected $guarded = ['id'];


    public function registrationFormParameterTemplateTable()
    {
        return $this->hasOne('App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateTable','id','registration_form_parameter_template_table_id');
    }

    public function registrationFormParameterTemplate()
    {
        return $this->hasOne('App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplate','id','registration_form_parameter_template_id');
    }

    public function columnParameterTemplate()
    {
        return $this->hasOne('App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplate','id','column_parameter_template_id');
    }
}
