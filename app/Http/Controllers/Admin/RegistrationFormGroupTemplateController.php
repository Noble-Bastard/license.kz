<?php

namespace App\Http\Controllers\Admin;


use App\Data\RegistrationFormTemplate\Dal\ParameterGroupDal;
use App\Data\RegistrationFormTemplate\Dal\RegistrationFormGroupTemplateDal;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class RegistrationFormGroupTemplateController extends Controller
{

    private $validate = [
        'registration_form_template_id' => 'required',
        'parameter_group_id' => 'required'
    ];

    public function entityList(){

        $registrationFormTemplateId = Input::get('registrationFormTemplateId');
        $registrationFormGroupTemplateList = RegistrationFormGroupTemplateDal::getListByRegistrationFormTemplateId($registrationFormTemplateId);;

        return response()->json($registrationFormGroupTemplateList);
    }

    public function store(Request $request){
        Validator::make($request->all(), $this->validate)->validate();

        $entity = new RegistrationFormGroupTemplate();
        $entity->id = Input::get('id');
        $entity->registration_form_template_id = Input::get('registration_form_template_id');
        $entity->parameter_group_id = Input::get('parameter_group_id');
        $entity->order_number = Input::get('order_number');
        $entity = RegistrationFormGroupTemplateDal::set($entity);

        return response()->json($entity);
    }

    public function delete()
    {
        RegistrationFormGroupTemplateDal::delete(Input::get('entityId'));
        return response()->json('1');
    }


    public function getParameterGroupList($registrationFormTemplateId)
    {
        $entityList = ParameterGroupDal::getAvailableListByRegistrationFormTemplate($registrationFormTemplateId);
        return response()->json($entityList);
    }


    public function move(Request $request)
    {
        $registrationFormGroupTemplateId = Input::get('registrationFormGroupTemplateId');
        $moveType = Input::get('moveType');
        RegistrationFormGroupTemplateDal::move($registrationFormGroupTemplateId,$moveType);
        return response()->json('1');
    }


}
