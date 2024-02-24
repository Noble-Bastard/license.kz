<?php

namespace App\Data\RegistrationFormTemplate\Dal;

use App\Data\Helper\Assistant;
use App\Data\Helper\MoveTypeList;
use App\Data\Helper\ParameterTypeList;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplate;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplate;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateTableStructure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegistrationFormParameterTemplateDal
{
    /**
     * Get RegistrationFormGroupTemplate list
     *
     * @param $withPaginate
     * @return mixed
     */
    public static function getList(bool $withPaginate)
    {
        if($withPaginate){
            return RegistrationFormParameterTemplate::paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return RegistrationFormParameterTemplate::get();
        }
    }


    public static function getListByRegistrationFormGroupTemplateId($registrationFormGroupTemplateId)
    {
        return RegistrationFormParameterTemplate::from('registration_form_parameter_template as rfpt')
            ->leftJoin('parameter_type as pt','rfpt.parameter_type_id','=','pt.id')
            ->leftJoin('optionset_type as ot','rfpt.optionset_type_id','=','ot.id')
            ->where('rfpt.registration_form_group_template_id',$registrationFormGroupTemplateId)
            ->orderBy('rfpt.order_number')
            ->get(['rfpt.*','pt.name as parameter_type_name','ot.name as optionset_type_name']);
    }

    /**
     * Get RegistrationFormParameterTemplate by Id
     *
     * @param $registrationFormParameterTemplateId
     * @return mixed
     */
    public static function get($entityId)
    {
        $registrationFormParameterTemplate = RegistrationFormParameterTemplate::where('id', $entityId)->firstOrFail();
        return $registrationFormParameterTemplate;
    }

    /**
     * Insert (or update)  RegistrationFormParameterTemplate
     *
     * @param RegistrationFormParameterTemplate $district
     * @return RegistrationFormParameterTemplate
     */
    public static function set (RegistrationFormParameterTemplate $srcEntity, $templateTableId = null)
    {
        try {
            DB::beginTransaction();

            if (empty($srcEntity->id)) {
                $entity = new RegistrationFormParameterTemplate;
                if(is_null($srcEntity->order_number)) {
                    if(is_null($templateTableId)) {
                        $maxOrderNo = RegistrationFormParameterTemplate::where('registration_form_group_template_id', $srcEntity->registration_form_group_template_id)
                                ->max('order_number') + 10;

                    } else {
                        $maxOrderNo = RegistrationFormParameterTemplateTableStructure::from('registration_form_parameter_template_table_structure as ts')
                            ->join('registration_form_parameter_template as pt','ts.column_parameter_template_id','=','pt.id')
                            ->where('registration_form_parameter_template_table_id',$templateTableId)
                            ->max('pt.order_number') + 10;
                    }
                    $srcEntity->order_number = $maxOrderNo;
                }
            } else {
                $entity = RegistrationFormParameterTemplate::where('id', $srcEntity->id)->firstOrFail();

                if(is_null($templateTableId) && $entity->parameter_type_id == ParameterTypeList::Table && $srcEntity->parameter_type_id != ParameterTypeList::Table)
                {
                    RegistrationFormParameterTemplateTableDal::deleteByRegistrationFormParameterTemplateId($entity->id);
                }
            }
            $entity->registration_form_group_template_id = $srcEntity->registration_form_group_template_id;
            $entity->parameter_type_id = $srcEntity->parameter_type_id;
            $entity->caption = $srcEntity->caption;
            $entity->is_active = $srcEntity->is_active;
            $entity->comment = $srcEntity->comment;
            $entity->order_number = $srcEntity->order_number;
            $entity->optionset_type_id = $srcEntity->optionset_type_id;
            $entity->save();

            if(is_null($templateTableId) && $srcEntity->parameter_type_id == ParameterTypeList::Table)
            {
                RegistrationFormParameterTemplateTableDal::set($entity->id, $srcEntity->caption);
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


    public static function move ($entityId, $moveType, $templateTableId = null)
    {

        $entity = RegistrationFormParameterTemplate::where('id', $entityId)->firstOrFail();
        $currentOrderNumber = $entity->order_number;

        if(is_null($templateTableId)) {
            $destEntity = RegistrationFormParameterTemplate::from('registration_form_parameter_template as pt')
                ->where('pt.registration_form_group_template_id', $entity->registration_form_group_template_id);
        }
        else {
            $destEntity = RegistrationFormParameterTemplateTableStructure::from('registration_form_parameter_template_table_structure as ts')
                ->join('registration_form_parameter_template as pt','ts.column_parameter_template_id','=','pt.id')
                ->where('registration_form_parameter_template_table_id',$templateTableId);
        }

        if($moveType == MoveTypeList::UP)
        {
            $destEntity = $destEntity
                ->where('pt.order_number','<',$entity->order_number)
                ->orderBy('pt.order_number','desc')
                ->first(["pt.*"]);
        } else {
            $destEntity = $destEntity
                ->where('pt.order_number','>',$entity->order_number)
                ->orderBy('pt.order_number')
                ->first(["pt.*"]);
        }



        try {
            DB::beginTransaction();

            if (!is_null($destEntity)) {

                if(!is_null($templateTableId)) {
                    $destEntity = self::get($destEntity->id);
                }

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
     * Delete RegistrationFormParameterTemplate
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {

        $entity = self::get($entityId);
        try {
            DB::beginTransaction();

            if($entity->parameter_type_id == ParameterTypeList::Table)
            {
                RegistrationFormParameterTemplateTableDal::deleteByRegistrationFormParameterTemplateId($entityId);
            }

            RegistrationFormParameterTemplate::where('id', $entityId)->delete();

            DB::commit();

            return true;

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }

    }

}
