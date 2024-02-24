<?php

namespace App\Data\RegistrationFormTemplate\Dal;

use App\Data\Core\Model\CounterType;
use App\Data\Helper\Assistant;
use App\Data\Helper\ParameterTypeList;
use App\Data\RegistrationFormTemplate\Model\OptionsetType;
use App\Data\RegistrationFormTemplate\Model\OptionsetValueTemplate;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplateExt;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateTableStructureExt;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplate;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplateExt;
use App\Data\RegistrationFormTemplate\Model\ServiceRegistrationFormTemplate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use stdClass;

class RegistrationFormTemplateDal
{


    public static function get($entityId)
    {
        $entity = RegistrationFormTemplate::where('id', $entityId)->firstOrFail();
        return $entity;
    }


    public static function getList($withPaginate = false)
    {

        $entityList = CounterType::from("registration_form_template as rft")
            ->leftJoin("counter_type as ct",'rft.counter_type_id','=','ct.id')
            ->orderBy("rft.id");

        if($withPaginate){
            return $entityList->select(["rft.*","ct.name as counter_type_name"])->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get(["rft.*","ct.name as counter_type_name"]);
        }

    }


    public static function delete(int $entityId)
    {
        try {
            DB::beginTransaction();
            RegistrationFormTemplate::where('id', $entityId)->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public static function set(RegistrationFormTemplate $srcEntity)
    {
        try {
            DB::beginTransaction();
            $newEntity = is_null($srcEntity->id) ? new RegistrationFormTemplate() : RegistrationFormTemplate::where('id', $srcEntity->id)->firstOrFail();
            $newEntity->name = $srcEntity->name;
            $newEntity->counter_type_id = $srcEntity->counter_type_id;
            $newEntity->save();

            DB::commit();
            return self::get($newEntity->id);

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }


    public static function getRegistrationFormTemplate($serviceId)
    {
        $serviceRegistrationFormTemplate = ServiceRegistrationFormTemplate::where('service_id',$serviceId)->firstOrFail();
        $entityList = RegistrationFormTemplateExt::where('id',$serviceRegistrationFormTemplate->registration_form_template_id)->get();
        return $entityList;
    }


    public static function getRegistrationFormGroupTemplateList($serviceId)
    {
        $serviceRegistrationFormTemplate = ServiceRegistrationFormTemplate::where('service_id',$serviceId)->first();
        if(is_null($serviceRegistrationFormTemplate)){
            return null;
        }

        $entityList = RegistrationFormGroupTemplateExt::where('registration_form_template_id',$serviceRegistrationFormTemplate->registration_form_template_id)
            ->get();
        return $entityList;
    }

    public static function getRegistrationFormParameterTemplateList($serviceId)
    {
        $serviceRegistrationFormTemplate = ServiceRegistrationFormTemplate::where('service_id',$serviceId)->first();
        if(is_null($serviceRegistrationFormTemplate)){
            return null;
        }
        $entityList = RegistrationFormParameterTemplateExt::where('registration_form_template_id',$serviceRegistrationFormTemplate->registration_form_template_id)->get();
        return $entityList;
    }

    public static function getRegistrationFormParameterTemplate($registrationFormParameterTemplateId)
    {
        $registrationFormParameterTemplate = RegistrationFormParameterTemplateExt::where('id',$registrationFormParameterTemplateId)->first();
        return $registrationFormParameterTemplate;
    }

    public static function getTableMetadata($serviceId)
    {
        $serviceRegistrationFormTemplate = ServiceRegistrationFormTemplate
            ::where('service_id',$serviceId)
            ->first();

        if(is_null($serviceRegistrationFormTemplate))
        {
            return null;
        }

        $tableParameterIdList = RegistrationFormParameterTemplateExt
            ::where('registration_form_template_id',$serviceRegistrationFormTemplate->registration_form_template_id)
            ->where('parameter_type_id',ParameterTypeList::Table)
            ->get(['id'])->toArray();

        if(empty($tableParameterIdList))
        {
           return null;
        }

        $entityList = array();

        foreach ($tableParameterIdList as $tableParameterId)
        {
            $columnParameterIdList = RegistrationFormParameterTemplateTableStructureExt
                ::where('registration_form_parameter_template_id',$tableParameterId['id'])
                ->get(['column_parameter_template_id'])->toArray();

            $columnParameterEntityList = RegistrationFormParameterTemplateExt
                ::whereIn('id',$columnParameterIdList)->get()->toArray();

            $tableMetadata = new stdClass();
            $tableMetadata->tableParameterId = $tableParameterId['id'];
            $tableMetadata->columnParameterList = $columnParameterEntityList;

            array_push($entityList, $tableMetadata);
        }

        return $entityList;
    }


    /**
     * @param $entityId
     * @return mixed
     */
    public static function getOptionsetType($entityId)
    {
        $entity = OptionsetType::where('id', $entityId)->firstOrFail();
        return $entity;
    }

    public static function getOptionsetValueTemplate($entityId)
    {
        $entity = OptionsetValueTemplate::where('id', $entityId)->firstOrFail();
        return $entity;
    }


    /**
     * Get option set list
     *
     * @return Collection | OptionsetType
     */
    public static function getOptionsetTypeList($withPaginate = false)
    {
        $entityList = OptionsetType::orderBy('id');

        if($withPaginate){
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }


    public static function getOptionsetValueTemplateList($optionsetTypeId, $withPaginate = false)
    {
        $entityList = OptionsetValueTemplate::where('optionset_type_id',$optionsetTypeId)
            ->orderBy('id');

        if($withPaginate){
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }


    /**
     * @param OptionsetType $srcEntity
     * @return mixed
     * @throws \Exception
     */
    public static function setOptionsetType(OptionsetType $srcEntity)
    {
        try {
            DB::beginTransaction();
            $newEntity = is_null($srcEntity->id) ? new OptionsetType() : OptionsetType::where('id', $srcEntity->id)->firstOrFail();
            $newEntity->name = $srcEntity->name;
            $newEntity->save();

            DB::commit();
            return self::getOptionsetType($newEntity->id);

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public static function setOptionsetValueTemplate(OptionsetValueTemplate $srcEntity)
    {
        try {

            DB::beginTransaction();

            if($srcEntity->is_default == 1)
            {
                OptionsetValueTemplate::where('optionset_type_id', '=', $srcEntity->optionset_type_id)
                    ->where('is_default','=',true)
                    ->update(['is_default' => false]);
            }

            if(is_null($srcEntity->id))
            {
                $maxOptionsetId = OptionsetValueTemplate::where('optionset_type_id',$srcEntity->optionset_type_id)
                    ->max('optionset_id') ?? 0;
                $srcEntity->optionset_id  = $maxOptionsetId + 1;
            }

            $newEntity = is_null($srcEntity->id) ? new OptionsetValueTemplate() : OptionsetValueTemplate::where('id', $srcEntity->id)->firstOrFail();
            $newEntity->optionset_type_id = $srcEntity->optionset_type_id;
            $newEntity->optionset_value = $srcEntity->optionset_value;
            $newEntity->optionset_id = $srcEntity->optionset_id;
            $newEntity->is_default = $srcEntity->is_default;
            $newEntity->save();

            DB::commit();
            return self::getOptionsetValueTemplate($newEntity->id);

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public static function deleteOptionsetType(int $entityId)
    {
        try {
            DB::beginTransaction();
            OptionsetValueTemplate::where('optionset_type_id', $entityId)->delete();
            OptionsetType::where('id', $entityId)->delete();
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public static function deleteOptionsetValueTemplate(int $entityId)
    {
        try {
            DB::beginTransaction();
            OptionsetValueTemplate::where('id', $entityId)->delete();
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }


}
