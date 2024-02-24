<?php

namespace App\Http\Controllers\Admin\Dictionary;

use App\Data\Company\Model\Company;
use App\Data\Company\Dal\CompanyDal;

use App\Data\Helper\FilePathHelper;
use App\Data\Helper\TranslationAttributeList;
use App\Data\Service\Dal\CityDal;
use App\Data\Service\Dal\CountryDal;

use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    private $entityName = 'company';
    private $validateRule = [
        'name' => 'required|string|max:128',
        'address' => 'required|string|max:1024',
        'city_id' => 'required|numeric',
        'email' => 'required|string|max:64',
        'phone' => 'required|string|max:20',
        'location' => 'required|string|max:30',
//        'beneficiary' => 'required|string|max:1024',
//        'bank' => 'required|string|max:512',
//        'BIN' => 'required|string|max:30',
//        'IIK' => 'required|string|max:30',
//        'KBE' => 'required|string|max:10',
//        'BIK' => 'required|string|max:30',
//        'payment_code' => 'required|string|max:10',
    ];

    public function index()
    {
        $countryList = CountryDal::getList(false);
        return view('admin.dictionary.company.index')
            ->with('countryList', $countryList);
    }

    public function getListByCountry($countryId)
    {
        $entityList = CompanyDal::getListByCountry($countryId, false, true);

        $result = new \stdClass();
        $result->entityList = $entityList;
        $result->cityList = CityDal::getListByCountry($countryId, false);

        return response()->json($result);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), $this->validateRule)->validate();

        $entity = $this->set(false);

        return response()->json($entity);
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), $this->validateRule)->validate();

        $entity = $this->set(true);

        return response()->json($entity);
    }

    private function set(bool $id = false){
        $entity = new Company();

        if($id){
            $entity->id = Input::get('id');
        }

        $entity->name = Input::get('name');
        $entity->address = Input::get('address');
        $entity->city_id = Input::get('city_id');
        $entity->email = Input::get('email');
        $entity->skype = Input::get('skype');
        $entity->phone = Input::get('phone');
        $entity->phone_1 = Input::get('phone_1');
        $entity->fax = Input::get('fax');
        $entity->location = Input::get('location');
//        $entity->beneficiary = Input::get('beneficiary');
//        $entity->bank = Input::get('bank');
//        $entity->BIN = Input::get('BIN');
//        $entity->IIK = Input::get('IIK');
//        $entity->KBE = Input::get('KBE');
//        $entity->BIK = Input::get('BIK');
        $entity->beneficiary = null;
        $entity->bank = null;
        $entity->BIN = null;
        $entity->IIK = null;
        $entity->KBE = null;
        $entity->BIK = null;
        $entity->payment_code = '';

        TranslationDal::extendEntityAttribute($this->entityName, $entity);

        $entity = CompanyDal::set($entity);

        return $entity;
    }

    public function delete()
    {
        CompanyDal::delete(Input::get('entityId'));

        return response()->json('1');
    }

    public function changePhoto($id, Request $request)
    {
        $path = $request->file('photo')->store(FilePathHelper::getCompanyPhotoPath());

        CompanyDal::setPhotoPath($id, $path);
        return response()->json('1');
    }
}
