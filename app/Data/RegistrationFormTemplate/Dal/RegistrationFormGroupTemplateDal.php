<?php

namespace App\Data\RegistrationFormTemplate\Dal;

use App\Data\Helper\Assistant;
use App\Data\Helper\MoveTypeList;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegistrationFormGroupTemplateDal
{
    /**
     * Get RegistrationFormGroupTemplate list
     *
     * @param $withPaginate
     * @return mixed
     */
    public static function getList(bool $withPaginate = false)
    {
        if($withPaginate){
            return RegistrationFormGroupTemplate::paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return RegistrationFormGroupTemplate::get();
        }
    }


    public static function getListByRegistrationFormTemplateId($registrationFormTemplateId)
    {
        return RegistrationFormGroupTemplate::from('registration_form_group_template as rfgt')
            ->join('parameter_group as pg','rfgt.parameter_group_id','=','pg.id')
            ->where('rfgt.registration_form_template_id',$registrationFormTemplateId)
            ->orderBy('rfgt.order_number')
            ->get(['rfgt.*','pg.name as parameter_group_name']);
    }

    /**
     * Get RegistrationFormGroupTemplate by Id
     *
     * @param $RegistrationFormGroupTemplateId
     * @return mixed
     */
    public static function get($entityId)
    {
        $RegistrationFormGroupTemplate = RegistrationFormGroupTemplate::where('id', $entityId)->firstOrFail();
        return $RegistrationFormGroupTemplate;
    }

    /**
     * Insert (or update)  RegistrationFormGroupTemplate
     *
     * @param RegistrationFormGroupTemplate $district
     * @return RegistrationFormGroupTemplate
     */
    public static function set (RegistrationFormGroupTemplate $srcEntity)
    {
        if (empty($srcEntity->id)) {
            $entity = new RegistrationFormGroupTemplate;
            if(is_null($srcEntity->order_number)) {
                $maxOrderNo = RegistrationFormGroupTemplate::where('registration_form_template_id', $srcEntity->registration_form_template_id)
                        ->max('order_number') + 10;
                $srcEntity->order_number = $maxOrderNo;
            }
        } else {
            $entity = RegistrationFormGroupTemplate::where('id', $srcEntity->id)->firstOrFail();
        }
        $entity->registration_form_template_id = $srcEntity->registration_form_template_id;
        $entity->parameter_group_id = $srcEntity->parameter_group_id;
        $entity->order_number = $srcEntity->order_number;
        $entity->save();
        return $entity;
    }

    public static function move ($entityId, $moveType)
    {

        $entity = RegistrationFormGroupTemplate::where('id', $entityId)->firstOrFail();
        $destEntity = RegistrationFormGroupTemplate::where('registration_form_template_id',$entity->registration_form_template_id);
        $currentOrderNumber = $entity->order_number;

        if($moveType == MoveTypeList::UP)
        {
            $destEntity = $destEntity
                ->where('order_number','<',$entity->order_number)
                ->orderBy('order_number','desc')
                ->first();
        } else {
            $destEntity = $destEntity
                ->where('order_number','>',$entity->order_number)
                ->orderBy('order_number')
                ->first();
        }

        try {
            DB::beginTransaction();

            if (!is_null($destEntity)) {
                $entity->order_number = $destEntity->order_number;
                $entity->save();
                $destEntity->order_number = $currentOrderNumber;
                $destEntity->save();
            }

            DB::commit();

            return $entity;

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    /**
     * Delete RegistrationFormGroupTemplate
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        RegistrationFormGroupTemplate::where('id', $entityId)->delete();
        return true;
    }

}
