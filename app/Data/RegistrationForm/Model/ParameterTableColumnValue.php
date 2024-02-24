<?php

namespace App\Data\RegistrationForm\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationForm\Model\ParameterTableColumnValue
 *
 * @property int $id
 * @property int $registration_form_parameter_id
 * @property int $row_id
 * @property int $column_value_id
 * @property-read \App\Data\RegistrationForm\Model\RegistrationFormParameter $columnValue
 * @property-read \App\Data\RegistrationForm\Model\RegistrationFormParameter $registrationFormParameter
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\ParameterTableColumnValue whereColumnValueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\ParameterTableColumnValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\ParameterTableColumnValue whereRegistrationFormParameterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\ParameterTableColumnValue whereRowId($value)
 * @mixin \Eloquent
 */
class ParameterTableColumnValue extends Model
{
    protected $table = 'parameter_table_column_value';
    public $timestamps = false;

    protected $fillable = [
        'registration_form_parameter_id',
        'row_id',
        'column_value_id'
    ];
    protected $guarded = ['id'];


    public function registrationFormParameter()
    {
        return $this->hasOne('App\Data\RegistrationForm\Model\RegistrationFormParameter','id','registration_form_parameter_id');
    }

    public function columnValue()
    {
        return $this->hasOne('App\Data\RegistrationForm\Model\RegistrationFormParameter','id','column_value_id');
    }
}
