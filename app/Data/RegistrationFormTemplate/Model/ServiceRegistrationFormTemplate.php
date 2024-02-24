<?php

namespace App\Data\RegistrationFormTemplate\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationFormTemplate\Model\ServiceRegistrationFormTemplate
 *
 * @property int $id
 * @property int $service_id
 * @property int $registration_form_template_id
 * @property-read \App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplate $registrationFormTemplate
 * @property-read \App\Data\Service\Model\Service $service
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\ServiceRegistrationFormTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\ServiceRegistrationFormTemplate whereRegistrationFormTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\ServiceRegistrationFormTemplate whereServiceId($value)
 * @mixin \Eloquent
 */
class ServiceRegistrationFormTemplate extends Model
{
    protected $table = 'service_registration_form_template';
    public $timestamps = false;

    protected $fillable = [
        'service_id',
        'registration_form_template_id'
    ];
    protected $guarded = ['id'];


    public function service()
    {
        return $this->hasOne('App\Data\Service\Model\Service','id','service_id');
    }

    public function registrationFormTemplate()
    {
        return $this->hasOne('App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplate','id','registration_form_template_id');
    }

}
