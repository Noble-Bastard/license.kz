<?php

namespace App\Http\Controllers\Company;

use App\Data\Helper\Assistant;
use App\Data\StandartContractTemplate\Dal\StandartContractTemplateDal;
use App\Data\StandartContractTemplate\Dal\StandartContractTemplateTypeDal;
use App\Data\StandartContractTemplate\Model\StandartContractTemplate;
use App\Data\Helper\FilePathHelper;
use App\Data\Service\Dal\CountryDal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StandartContractTemplateController extends Controller
{
    private $validate = [
        'country_id' => 'required',
        'friendly_name' => 'required|string|max:256',
        'standart_contract_template_type_id' => 'required',
        'file.*' => 'required|mimes:doc,docx,xls,xlsx,zip'
    ];


    public function index()
    {
        $standartContractTemplateTypeList = StandartContractTemplateTypeDal::getList();
        $countryList = CountryDal::getList(false);
        return view('company.standart_contract_template')
            ->with("standartContractTemplateTypeList",$standartContractTemplateTypeList)
            ->with("countryList",$countryList);
    }


    public function entityList(){
        $countryId = Input::get('countryId');
        $standartContractTemplateList = StandartContractTemplateDal::getListByCountry($countryId);
        return response()->json($standartContractTemplateList);
    }

    public function commonDataEntityList(){
        $standartContractTemplateTypeId = Input::get('standartContractTemplateTypeId');
        $standartContractTemplateList = StandartContractTemplateDal::getListByTypeAndCurrentCountry($standartContractTemplateTypeId);
        return response()->json($standartContractTemplateList);
    }


    public function store(Request $request){
        Validator::make($request->all(), $this->validate)->validate();

        $countryId = Input::get('country_id');
        $standartContractTemplateTypeId = Input::get('standart_contract_template_type_id');
        $file = $request->file('file');
        $path = $file->store(FilePathHelper::getCompanyStandartContractTemplatePath());
        $entity = new StandartContractTemplate();
        $entity->name = $file->getClientOriginalName();
        $entity->friendly_name = Input::get('friendly_name');
        $entity->path = $path;
        $entity->country_id = $countryId;
        $entity->standart_contract_template_type_id = $standartContractTemplateTypeId;
        $entity = StandartContractTemplateDal::set($entity);
        return response()->json($entity);
    }

    public function delete()
    {
        $standartContractTemplateId = Input::get('entityId');
        $standartContractTemplate = StandartContractTemplateDal::get($standartContractTemplateId);
        StandartContractTemplateDal::delete($standartContractTemplateId);
        Storage::delete($standartContractTemplate->path);
        return response()->json('1');
    }

    public function download()
    {
        $standartContractTemplateId = Input::get('entityId');
        $standartContractTemplate = StandartContractTemplateDal::get($standartContractTemplateId);
        return FilePathHelper::downloadFile($standartContractTemplate->path, $standartContractTemplate->name);
    }


}
