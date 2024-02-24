<?php

namespace App\Http\Controllers\Admin;


use App\Data\Helper\ParameterTypeList;
use App\Data\RegistrationFormTemplate\Dal\ParameterGroupDal;
use App\Data\RegistrationFormTemplate\Dal\RegistrationFormGroupTemplateDal;
use App\Data\RegistrationFormTemplate\Dal\RegistrationFormParameterTemplateDal;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplate;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class RegistrationFormParameterTemplateController extends Controller
{

    public function entityList($registrationFormGroupTemplateId){
        $registrationFormParameterTemplateList = RegistrationFormParameterTemplateDal::getListByRegistrationFormGroupTemplateId($registrationFormGroupTemplateId);;
        return response()->json($registrationFormParameterTemplateList);
    }

    public function store(Request $request){

        $validate = [
            'caption' => 'required|string|max:255',
            'parameter_type_id' => 'required',
            'registration_form_group_template_id' => 'required',
            'optionset_type_id' => ['required_if:parameter_type_id,'.ParameterTypeList::OptionSet]
        ];

        $validator = Validator::make($request->all(), $validate);
        $validator->validate();

        $entity = new RegistrationFormParameterTemplate();
        $entity->id = Input::get('id');
        $entity->registration_form_group_template_id = Input::get('registration_form_group_template_id');
        $entity->parameter_type_id =  Input::get('parameter_type_id');
        $entity->caption = Input::get('caption');
        $entity->is_active = Input::get('is_active');
        $entity->comment = Input::get('comment');
        $entity->order_number = Input::get('order_number');
        $entity->optionset_type_id = Input::get('optionset_type_id');
        $entity = RegistrationFormParameterTemplateDal::set($entity);

        return response()->json($entity);
    }

    public function delete()
    {
        RegistrationFormParameterTemplateDal::delete(Input::get('entityId'));
        return response()->json('1');
    }
    


    public function move(Request $request)
    {
        $registrationFormParameterTemplateId = Input::get('registrationFormParameterTemplateId');
        $moveType = Input::get('moveType');
        RegistrationFormParameterTemplateDal::move($registrationFormParameterTemplateId,$moveType);
        return response()->json('1');
    }


}
