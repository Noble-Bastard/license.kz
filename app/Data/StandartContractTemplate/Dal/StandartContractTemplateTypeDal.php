<?php

namespace App\Data\StandartContractTemplate\Dal;

use App\Data\StandartContractTemplate\Model\StandartContractTemplateType;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StandartContractTemplateTypeDal
{

    public static function get($entityId, $translateData = false)
    {
        $query = (new StandartContractTemplateType())->getBaseQuery();
        $query->where($query->getModel()->getTableName() . '.id', $entityId);
        $queryWithTranslation = (new TranslationDal())->generateTableQueryByBuilder($query, $translateData);
        return  $queryWithTranslation->first();
    }

    public static function getList()
    {
        $query = (new TranslationDal())->generateTableQueryByBuilder(
            (new StandartContractTemplateType())->getBaseQuery(),
            true
        );

        return $query->get();
    }

    public static function set(StandartContractTemplateType $srcEntity)
    {
        try {
            DB::beginTransaction();

            $entity = (empty($srcEntity->id)) ?
                new StandartContractTemplateType()
                :  StandartContractTemplateType::where('id', $srcEntity->id)->firstOrFail();
            $entity->name = $srcEntity->name;
            $entity->save();
            TranslationDal::setEntityTranslation($entity->getTableName(), $entity->id, $srcEntity);

            DB::commit();

            return self::get($entity->id);

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public static function delete($entityId)
    {
        try {
            DB::beginTransaction();

            TranslationDal::deleteByEntity((new StandartContractTemplateType)->getTableName(), $entityId);
            StandartContractTemplateType::where('id', $entityId)->delete();

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
