<?php

namespace App\Http\Controllers\Admin;

use App\Data\Core\Dal\CounterTypeDal;
use App\Data\RegistrationFormTemplate\Dal\ParameterGroupDal;
use App\Data\RegistrationFormTemplate\Dal\ParameterTypeDal;
use App\Data\RegistrationFormTemplate\Dal\RegistrationFormTemplateDal;
use App\Data\RegistrationFormTemplate\Model\OptionsetType;
use App\Data\RegistrationFormTemplate\Model\OptionsetValueTemplate;
use App\Data\RegistrationFormTemplate\Model\ParameterGroup;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class RegistrationFormTemplateController extends Controller
{

    private $validateRule = [
        'name' => 'required|string|max:255'
    ];

    private $validateRuleRegistrationFormTemplate = [
        'name' => 'required|string|max:255',
        'counter_type_id' => 'required',
    ];

    private $validateRuleOptionsetValueTemplate = [
        'optionset_value' => 'required|string|max:255'
    ];


    public function index()
    {
        $counterTypeList = CounterTypeDal::getList(false);

        return view('admin.registrationFormTemplate.index')
            ->with("counterTypeList",$counterTypeList);
    }

    public function show($registrationFormTemplateId)
    {
        $registrationFormTemplate = RegistrationFormTemplateDal::get($registrationFormTemplateId);
        $optionsetTypeList = RegistrationFormTemplateDal::getOptionsetTypeList(false);
        $parameterTypeList = ParameterTypeDal::getList(false);

        return view('admin.registrationFormTemplate.card')
            ->with("registrationFormTemplate",$registrationFormTemplate)
            ->with("parameterTypeList",$parameterTypeList)
            ->with("optionsetTypeList",$optionsetTypeList);
    }

    public function entityList(){

        $entityList = RegistrationFormTemplateDal::getList(true);

        return response()->json($entityList);
    }

    public function store(Request $request){
        Validator::make($request->all(), $this->validateRuleRegistrationFormTemplate)->validate();

        $entity = new RegistrationFormTemplate();
        $entity->id = Input::get('id');
        $entity->name = Input::get('name');
        $entity->counter_type_id = Input::get('counter_type_id');
        $entity = RegistrationFormTemplateDal::set($entity);

        return response()->json($entity);
    }

    public function delete()
    {
        RegistrationFormTemplateDal::delete(Input::get('entityId'));
        return response()->json('1');
    }


    public function indexOptionsetType()
    {
        return view('admin.registrationFormTemplate.optionsetType.index');
    }

    public function indexParameterGroup()
    {
        return view('admin.registrationFormTemplate.parameterGroup.index');
    }

    public function entityListOptionsetType(){

        $entityList = RegistrationFormTemplateDal::getOptionsetTypeList(true);

        return response()->json($entityList);
    }

    public function entityListParameterGroup(){

        $entityList = ParameterGroupDal::getList(true);
        return response()->json($entityList);
    }

    public function entityListOptionsetValueTemplate(){

        $optionsetTypeId = Input::get('optionset_type_id');
        $entityList = RegistrationFormTemplateDal::getOptionsetValueTemplateList($optionsetTypeId,true);

        return response()->json($entityList);
    }


    public function storeOptionsetType(Request $request){
        Validator::make($request->all(), $this->validateRule)->validate();

        $entity = new OptionsetType();
        $entity->id = Input::get('id');
        $entity->name = Input::get('name');
        $entity = RegistrationFormTemplateDal::setOptionsetType($entity);

        return response()->json($entity);
    }

    public function storeParameterGroup(Request $request){
        Validator::make($request->all(), $this->validateRule)->validate();

        $entity = new ParameterGroup();
        $entity->id = Input::get('id');
        $entity->name = Input::get('name');
        $entity = ParameterGroupDal::set($entity);

        return response()->json($entity);
    }

    public function storeOptionsetValueTemplate(Request $request){
        Validator::make($request->all(), $this->validateRuleOptionsetValueTemplate)->validate();

        $entity = new OptionsetValueTemplate();
        $entity->id = Input::get('id');
        $entity->optionset_type_id = Input::get('optionset_type_id');
        $entity->optionset_value = Input::get('optionset_value');
        $entity->optionset_id = Input::get('optionset_id');
        $entity->is_default = Input::get('is_default');
        $entity = RegistrationFormTemplateDal::setOptionsetValueTemplate($entity);

        return response()->json($entity);
    }


    public function deleteOptionsetType()
    {
        RegistrationFormTemplateDal::deleteOptionsetType(Input::get('entityId'));
        return response()->json('1');
    }

    public function deleteParameterGroup()
    {
        ParameterGroupDal::delete(Input::get('entityId'));
        return response()->json('1');
    }

    public function deleteOptionsetValueTemplate()
    {
        RegistrationFormTemplateDal::deleteOptionsetValueTemplate(Input::get('entityId'));
        return response()->json('1');
    }


}
