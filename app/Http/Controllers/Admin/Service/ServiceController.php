<?php

namespace App\Http\Controllers\Admin\Service;

use App\Data\Core\Dal\CounterDal;
use App\Data\Core\Dal\CounterTypeDal;
use App\Data\Core\Model\CounterType;
use App\Data\Helper\Assistant;
use App\Data\RegistrationFormTemplate\Dal\RegistrationFormGroupTemplateDal;
use App\Data\RegistrationFormTemplate\Dal\RegistrationFormTemplateDal;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplate;
use App\Data\Service\Dal\CountryDal;
use App\Data\Service\Dal\CurrencyDal;
use App\Data\Service\Dal\LicenseTypeDal;
use App\Data\Service\Dal\ServiceDal;
use App\Data\Service\Dal\ServiceStepCostHistDal;
use App\Data\Service\Dal\ServiceStepDal;
use App\Data\Service\Dal\ServiceThematicGroupDal;
use App\Data\Service\Dal\ServiceTypeDal;
use App\Data\Service\Model\Service;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    private $entityName = 'service';

    private $validateRule = [
        'code' => 'required|string|max:64',
        'name' => 'required|string|max:1024',
        'description' => 'required|string|max:4096',
        'code_en' => 'string|max:64',
        'name_en' => 'string|max:1024',
        'description_en' => 'string|max:4096',
        'execution_days_from' => 'required|numeric',
        'execution_days_to' => 'required|numeric',
        'counter_type_id' => 'required|numeric',
        'service_thematic_group_id' => 'required|numeric'
    ];

    public function show($serviceCategoryId, $serviceThematicGroupId, $serviceId)
    {

        $registrationFormTemplateList = RegistrationFormTemplateDal::getList();

        return view('admin.service.service.card.index')
            ->with('entityId', $serviceId)
            ->with('serviceCategoryId', $serviceCategoryId)
            ->with('registrationFormTemplateList', $registrationFormTemplateList)
            ->with('serviceThematicGroupId', $serviceThematicGroupId);
    }

    public function get($serviceId)
    {
        $entity = ServiceDal::get($serviceId);

        $data = new \stdClass();
        $data->entity = $entity;
        $data->counterTypeList = CounterTypeDal::getList(false);
        $data->licenseTypeList = (new LicenseTypeDal())->getList(false);
        $data->serviceTypeList = (new ServiceTypeDal())->getList(false);

        return response()->json($data);
    }

    public function store(Request $request){
        Validator::make($request->all(), $this->validateRule)->validate();

        $result = $this->set(false);

        return $result;
    }

    public function update(Request $request){
        Validator::make($request->all(), $this->validateRule)->validate();

        $result = $this->set(true);

        return $result;
    }

    private function set(bool $id = false){
        $entity = new Service();

        if($id){
            $entity->id = Input::get('id');
        }

        $entity->is_active = Input::get('is_active');
        $entity->name = Input::get('name');
        $entity->code = Input::get('code');
        $entity->description = Input::get('description');
        $entity->comment = Input::get('comment');
        $entity->execution_days_from = Input::get('execution_days_from');
        $entity->execution_days_to = Input::get('execution_days_to');
        $entity->service_thematic_group_id = Input::get('service_thematic_group_id');
        $entity->service_start_date = Assistant::getCurrentDate();
        $entity->service_end_date = null;
        $entity->counter_type_id = Input::get('counter_type_id');
        $entity->registration_form_template_id = Input::get('registration_form_template_id');
        $entity->executive_agency = Input::get('executive_agency');
        $entity->live_period = Input::get('live_period');
        $entity->service_type_id = Input::get('service_type_id');
        $entity->base_cost = Input::get('base_cost');
        $entity->additional_cost = Input::get('additional_cost');

        TranslationDal::extendEntityAttribute($this->entityName, $entity);

        $entity = ServiceDal::set($entity);

        return response()->json($entity);
    }

    public function index(){

        $countryList = CountryDal::getList();

        return view('admin.service.service.list.index')
            ->with('countryList', $countryList);
            
    }

    public function entityList(){
        $entityList = ServiceDal::getList(
            true,
            Input::get('countryId'),
            Input::get('serviceCategoryId'),
            Input::get('searchText')
        );
        return response()->json($entityList);
    }

    public function delete()
    {
        ServiceDal::delete(Input::get('entityId'));
    }

    public function move()
    {
        $entityId = Input::get('entityId');
        $serviceThematicGroupId = Input::get('serviceThematicGroupId');
        ServiceDal::move($entityId, $serviceThematicGroupId);

        return response()->json('1');
    }
}
