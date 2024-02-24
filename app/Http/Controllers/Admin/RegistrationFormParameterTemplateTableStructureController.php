<?php

namespace App\Http\Controllers\Admin;


use App\Data\Helper\ParameterTypeList;
use App\Data\RegistrationFormTemplate\Dal\ParameterGroupDal;
use App\Data\RegistrationFormTemplate\Dal\RegistrationFormGroupTemplateDal;
use App\Data\RegistrationFormTemplate\Dal\RegistrationFormParameterTemplateDal;
use App\Data\RegistrationFormTemplate\Dal\RegistrationFormParameterTemplateTableDal;
use App\Data\RegistrationFormTemplate\Dal\RegistrationFormParameterTemplateTableStructureDal;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplate;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class RegistrationFormParameterTemplateTableStructureController extends Controller
{

    public function entityList($parameterTemplateId){
        $registrationFormParameterTemplateTableStructureList = RegistrationFormParameterTemplateTableStructureDal::getList($parameterTemplateId);;
        return response()->json($registrationFormParameterTemplateTableStructureList);
    }

    public function store(Request $request){

        $validate = [
            'caption' => 'required|string|max:255',
            'parameter_type_id' => 'required',
            'tableParameterId' => 'required',
            'optionset_type_id' => ['required_if:parameter_type_id,'.ParameterTypeList::OptionSet]
        ];

        $validator = Validator::make($request->all(), $validate);
        $validator->validate();

        $tableParameterId = Input::get('tableParameterId');
        $templateTable = RegistrationFormParameterTemplateTableDal::getByParameterId($tableParameterId);
        $columnParameterTemplateId = Input::get('column_parameter_template_id');

        $entity = new RegistrationFormParameterTemplate();
        $entity->id = $columnParameterTemplateId;
        $entity->registration_form_group_template_id = null;
        $entity->parameter_type_id =  Input::get('parameter_type_id');
        $entity->caption = Input::get('caption');
        $entity->is_active = Input::get('is_active');
        $entity->comment = Input::get('comment');
        $entity->order_number = Input::get('order_number');
        $entity->optionset_type_id = Input::get('optionset_type_id');
        $entity = RegistrationFormParameterTemplateTableStructureDal::set(
            $templateTable->id,
            $entity
        );

        return response()->json($entity);
    }

    public function delete()
    {
        RegistrationFormParameterTemplateTableStructureDal::delete(Input::get('entityId'));
        return response()->json('1');
    }
    


    public function move(Request $request)
    {
        $entityId = Input::get('entityId');
        $moveType = Input::get('moveType');

        $tableStructureEntity = RegistrationFormParameterTemplateTableStructureDal::get($entityId);

        RegistrationFormParameterTemplateDal::move(
            $tableStructureEntity->column_parameter_template_id,
            $moveType,
            $tableStructureEntity->registration_form_parameter_template_table_id
        );
        return response()->json('1');
    }


}
