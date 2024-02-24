<?php

namespace App\Http\Controllers\Company;


use App\Data\DocumentTemplate\Dal\DocumentTemplateDal;
use App\Data\DocumentTemplate\Dal\DocumentTemplateTypeDal;
use App\Data\DocumentTemplate\Model\DocumentTemplate;
use App\Data\Helper\FilePathHelper;
use App\Data\Service\Dal\CountryDal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DocumentTemplateController extends Controller
{
    private $validate = [
        'country_id' => 'required',
        'document_template_type_id' => 'required',
        'file.*' => 'required|mimes:doc,docx,xls,xlsx,zip'
    ];

//|max:10000|mimes:doc,docx,xls,xlsx

    public function index()
    {
        $documentTemplateTypeList = DocumentTemplateTypeDal::getList();
        $countryList = CountryDal::getList(false);
        return view('company.document_template')
            ->with("documentTemplateTypeList",$documentTemplateTypeList)
            ->with("countryList",$countryList);
    }


    public function entityList(){

        $countryId = Input::get('countryId');
        $documentTemplateList = DocumentTemplateDal::getListByCountry($countryId);
        return response()->json($documentTemplateList);
    }


    public function store(Request $request){
        Validator::make($request->all(), $this->validate)->validate();

        $countryId = Input::get('country_id');
        $documentTemplateTypeId = Input::get('document_template_type_id');
        $file = $request->file('file');
        $curEntity = DocumentTemplateDal::getByCountryAndTemplateType($countryId, $documentTemplateTypeId);
        if(!is_null($curEntity->path))
        {
            Storage::delete($curEntity->path);
        }
        $path = $file->store(FilePathHelper::getCompanyDocumentTemplatePath());
        $entity = new DocumentTemplate();
        $entity->name = $file->getClientOriginalName();
        $entity->path = $path;
        $entity->country_id = $countryId;
        $entity->document_template_type_id = $documentTemplateTypeId;
        $entity = DocumentTemplateDal::set($entity);

        return response()->json($entity);

    }

    public function delete()
    {
        $documentTemplateId = Input::get('entityId');
        $documentTemplate = DocumentTemplateDal::get($documentTemplateId);
        DocumentTemplateDal::delete($documentTemplateId);
        Storage::delete($documentTemplate->path);
        return response()->json('1');
    }

    public function download()
    {
        $documentTemplateId = Input::get('entityId');
        $documentTemplate = DocumentTemplateDal::get($documentTemplateId);
        return FilePathHelper::downloadFile($documentTemplate->path, $documentTemplate->name);
    }


}
