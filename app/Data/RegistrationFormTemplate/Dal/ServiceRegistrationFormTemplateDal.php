<?php

namespace App\Data\RegistrationFormTemplate\Dal;

use App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplate;
use App\Data\RegistrationFormTemplate\Model\ServiceRegistrationFormTemplate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceRegistrationFormTemplateDal
{

    public static function getByServiceId($serviceIdd)
    {
        $entity = ServiceRegistrationFormTemplate::where('service_id', $serviceIdd)
            ->first();
        return $entity;
    }

    public static function deleteByService(int $entityId)
    {
        ServiceRegistrationFormTemplate::where('service_id', $entityId)->delete();
    }

    public static function set(ServiceRegistrationFormTemplate $srcEntity)
    {
        try {

            $existedEntity = self::getByServiceId($srcEntity->service_id);
            if(!is_null($existedEntity) && is_null($srcEntity->registration_form_template_id))
            {
                self::deleteByService($srcEntity->service_id);
                return null;
            }

            if(is_null($srcEntity->registration_form_template_id)){
                return null;
            }

            DB::beginTransaction();
            $newEntity = is_null($existedEntity) ? new ServiceRegistrationFormTemplate() : $existedEntity;
            $newEntity->service_id = $srcEntity->service_id;
            $newEntity->registration_form_template_id = $srcEntity->registration_form_template_id;
            $newEntity->save();

            DB::commit();
            return self::getByServiceId($newEntity->service_id);

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }


}
