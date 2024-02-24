<?php

namespace App\Http\Controllers\Admin;

use App\Data\Service\Dal\CountryDal;
use App\Data\Service\Model\Country;
use App\Data\Translation\Dal\TranslationDal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CountriesController extends Controller
{
    private $entityName = 'country';
    private $validateRule = [
        'code' => 'required|string|max:16',
        'name' => 'required|string|max:128'
    ];

    public function index()
    {
        $countryList = CountryDal::getList(true);
        return view('admin.countries.index')->with('countryList', $countryList);
    }

    public function get($id){
        $country = CountryDal::get($id);
        return view('country.fullCountry')
            ->with('country', $country);
    }

    public function entityList(){
        $countryList = CountryDal::getList();
        return response()->json($countryList);
    }

    public function create(){
        return view('admin.countries.create');
    }

    public function store(Request $request){
        Validator::make($request->all(), $this->validateRule)->validate();

        $entity = $this->set(false);

        return redirect(route('admin.countries.list'));
    }

    public function edit($id){
        $_country = CountryDal::get($id);

        return view('admin.countries.edit')
            ->with('_country', $_country);
    }

    public function update(Request $request){
        Validator::make($request->all(), $this->validateRule)->validate();

        $entity = $this->set(true);

        return redirect(route('admin.countries.list'));
    }

    private function set(bool $id = false){
        $entity = new Country();

        if($id){
            $entity->id = Input::get('id');
        }

        $entity->code = Input::get('code');
        $entity->is_visible = !is_null(Input::get('is_visible'));

        TranslationDal::extendEntityAttribute($this->entityName, $entity);

        $entity = CountryDal::set($entity);

        return $entity;
    }

    public function destroy($id)
    {
        CountryDal::delete($id);
        return redirect(route('admin.countries.list'));
    }
}
