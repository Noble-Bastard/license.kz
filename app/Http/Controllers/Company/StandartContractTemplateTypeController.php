<?php

namespace App\Http\Controllers\Company;

use App\Data\StandartContractTemplate\Dal\StandartContractTemplateDal;
use App\Data\StandartContractTemplate\Dal\StandartContractTemplateTypeDal;
use App\Data\StandartContractTemplate\Model\StandartContractTemplate;
use App\Data\Helper\FilePathHelper;
use App\Data\Service\Dal\CountryDal;
use App\Data\StandartContractTemplate\Model\StandartContractTemplateType;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StandartContractTemplateTypeController extends Controller
{
    private $validate = [
        'name' => 'required|string|max:256'
    ];

    public function index()
    {
        return view('company.standart_contract_template_type');
    }

    public function entityList(){
        $standartContractTemplateTypeList = StandartContractTemplateTypeDal::getList();
        return response()->json($standartContractTemplateTypeList);
    }


    public function store(Request $request){
        Validator::make($request->all(), $this->validate)->validate();

        $entity = new StandartContractTemplateType();
        $entity->id = Input::get('id');
        $entity->name = Input::get('name');
        TranslationDal::extendEntityAttribute($entity->getTableName(), $entity);
        $entity = StandartContractTemplateTypeDal::set($entity);
        return response()->json($entity);
    }

    public function delete()
    {
        $standartContractTemplateTypeId = Input::get('entityId');
        StandartContractTemplateTypeDal::delete($standartContractTemplateTypeId);
        return response()->json('1');
    }



}
