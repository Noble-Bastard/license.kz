<?php

namespace App\Http\Controllers\Admin\Service;

use App\Data\Service\Dal\CountryDal;
use App\Data\Service\Import\ServiceImportManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use stdClass;


class ServiceImportController extends Controller
{
    private $entityName = 'service';

    private $validate = [
        'countryId' => 'required',
        'serviceCategoryId' => 'required',
        'serviceThematicGroupId' => 'required',
        'file.*' => 'required|mimes:doc,docx,xls,xlsx,zip'
    ];

    public function index(){
        $countryList = CountryDal::getList();
        return view('admin.service.import.index')
            ->with('countryList', $countryList);
    }

    public function store(Request $request){
        Validator::make($request->all(), $this->validate)->validate();

        $serviceThematicGroupId = Input::get('serviceThematicGroupId');
        $file = $request->file('file');

        $serviceImportManager = new ServiceImportManager();

        $services = $serviceImportManager->import(
            $file,
            $serviceThematicGroupId
        );

        return response()->json($services);
    }

}
