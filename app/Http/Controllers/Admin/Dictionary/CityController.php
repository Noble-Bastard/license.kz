<?php

namespace App\Http\Controllers\Admin\Dictionary;

use App\Data\Core\Dal\CounterTypeDal;
use App\Data\Service\Dal\CityDal;
use App\Data\Service\Dal\CountryDal;
use App\Data\Service\Model\City;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    private $entityName = 'city';
    private $validateRule = [
        'country_id' => 'required|numeric',
        'value' => 'required|string|max:32'        
    ];

    public function index()
    {
        $countryList = CountryDal::getList(false);
        return view('admin.dictionary.city.index')
            ->with('countryList', $countryList);
    }

    public function getList($countryId)
    {
        $entityList = CityDal::getListByCountry($countryId, false);
        return response()->json($entityList);
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
        $entity = new City();

        if($id){
            $entity->id = Input::get('id');
        }

        $entity->country_id = Input::get('country_id');
        $entity->value = Input::get('value');

        TranslationDal::extendEntityAttribute($this->entityName, $entity);

        $entity = CityDal::set($entity);

        return $entity;
    }

    public function delete()
    {
        CityDal::delete(Input::get('entityId'));

        return response()->json('1');
    }
}
