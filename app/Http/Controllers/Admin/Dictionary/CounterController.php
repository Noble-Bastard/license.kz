<?php

namespace App\Http\Controllers\Admin\Dictionary;

use App\Data\Core\Dal\CounterDal;
use App\Data\Core\Dal\CounterTypeDal;
use App\Data\Core\Model\Counter;
use App\Data\Core\Model\CounterType;
use App\Data\Service\Dal\CountryDal;
use App\Data\Service\Dal\ServiceStepCostHistDal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CounterController extends Controller
{
    private $validateRule = [
        'counter_type_code' => 'required|string|max:32',
        'counter_type_name' => 'required|string|max:256',
        'mask' => 'required|string|max:50',
        'length' => 'required|numeric|min:2',
        'increase' => 'required|numeric|min:1'
    ];

    public function index()
    {
        $countryList = CountryDal::getList(false,true);
        return view('admin.dictionary.counter.index')
            ->with("countryList", $countryList);
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
        $entity = new CounterType();

        if(!is_null($id)){
            $entity->id = Input::get('counter_type_id');
        }

        $entity->code = mb_strtoupper (Input::get('counter_type_code'));
        $entity->name = Input::get('counter_type_name');
        $entity = CounterTypeDal::set($entity);

        $entityCounter = new Counter();
        if(!is_null($id)){
           $entityCounter->id = Input::get('id');
            $entityCounter->sequence = Input::get('sequence');;
        } else {
            $entityCounter->sequence = 1;
        }
        $entityCounter->counter_type_id = $entity->id;
        $entityCounter->mask = Input::get('mask');
        $entityCounter->length = Input::get('length');
        $entityCounter->increase = Input::get('increase');
        $entityCounter->country_id = Input::get('country_id');

        $entityCounter = CounterDal::set($entityCounter);

        $counterType = $entityCounter->counterType()->first();
        $entityCounter->counter_type_id = $counterType->id;
        $entityCounter->counter_type_code = $counterType->code;
        $entityCounter->counter_type_name = $counterType->name;

        return $entityCounter;
    }


    public function entityList()
    {
        $entityList = CounterDal::getList(false);

        foreach ($entityList as $entity){
            $counterType = $entity->counterType()->first();

            $entity->counter_type_id = $counterType->id;
            $entity->counter_type_code = $counterType->code;
            $entity->counter_type_name = $counterType->name;
        }

        return response()->json($entityList);
    }
}
