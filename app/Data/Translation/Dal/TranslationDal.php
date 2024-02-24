<?php

namespace App\Data\Translation\Dal;

use App\Data\Core\Dal\SettingDal;
use App\Data\Helper\Assistant;
use App\Data\Helper\TranslationAttributeList;
use App\Data\Interactor\RequestManager;
use App\Data\Translation\Model\Language;
use App\Data\Translation\Model\Translation;
use App\Data\Translation\Model\TranslationAttribute;
use App\Data\Translation\Model\TranslationEntity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class TranslationDal
{

    public static function get($entityId)
    {
        $Translation = Translation::where('id', $entityId)->firstOrFail();
        return $Translation;
    }

    public static function set(Translation $srcEntity)
    {
        $entity = Translation::where('pk_value', $srcEntity->pk_value)
            ->where('translation_attribute_id', $srcEntity->translation_attribute_id)
            ->where('language_id', $srcEntity->language_id)
            ->first();

        if (is_null($entity)) {
            $entity = new Translation();
        }

        $entity->translation_attribute_id = $srcEntity->translation_attribute_id;
        $entity->language_id = $srcEntity->language_id;
        $entity->value = $srcEntity->value;
        $entity->pk_value = $srcEntity->pk_value;
        $entity->save();
        return $entity;
    }

    public static function delete($translationAttributeId, $pkValue)
    {
        Translation::where('translation_attribute_id', $translationAttributeId)
            ->where('pk_value', $pkValue)
            ->delete();
        return true;
    }

    public static function getTranslationFieldsByTableName($tableName)
    {
        $translationEntity = TranslationEntity::where('name', $tableName)->first();
        if(is_null($translationEntity))
            return null;
        else
            return TranslationAttribute::where('translation_entity_id', $translationEntity->id)->get();
    }

    public static function deleteByEntity($entityName, $pkValue)
    {
        $translationEntity = TranslationEntity::where('name', $entityName)->first();
        if (!is_null($translationEntity)) {
            $translationAttributeList = self::getTranslationFields($translationEntity);
            foreach ($translationAttributeList as $translationAttribute) {
                self::delete($translationAttribute->id, $pkValue);
            }
        }
    }

    public static function setEntityTranslation(string $entityName, $entityId, $srcEntity)
    {
        $translationEntity = TranslationEntity::where('name', $entityName)->first();
        $languageList = Language::all();
        $appSettings = SettingDal::get();
        if (!is_null($translationEntity)) {
            $translationAttributeList = self::getTranslationFields($translationEntity);
            foreach ($translationAttributeList as $translationAttribute) {
                foreach ($languageList as $language) {
                    $attrName = $translationAttribute->name;
                    if ($language->id != $appSettings->default_language_id) {
                        $attrName .= '_' . $language->code;
                    }

                    if (isset($srcEntity[$attrName])) {
                        $translation = new Translation();
                        $translation->value = $srcEntity[$attrName];
                        $translation->language_id = $language->id;
                        $translation->pk_value = $entityId;
                        $translation->translation_attribute_id = $translationAttribute->id;
                        self::set(
                            $translation
                        );
                    }
                }
            }
        }
    }

    public static function extendEntityAttribute(string $entityName, $entity)
    {
        $translationEntity = TranslationEntity::where('name', $entityName)->first();
        $languageList = Language::all();
        $appSettings = SettingDal::get();
        if (!is_null($translationEntity)) {
            $translationAttributeList = self::getTranslationFields($translationEntity);
            foreach ($translationAttributeList as $translationAttribute) {
                foreach ($languageList as $language) {
                    $attrName = $translationAttribute->name;
                    if ($language->id != $appSettings->default_language_id) {
                        $attrName .= '_' . $language->code;
                    }

                    $entity[$attrName] = Input::get($attrName);
                }
            }
        }
    }

    public static function extractEntityTranslation(string $entityName, &$entityData)
    {
        $result = [];

        $translationEntity = TranslationEntity::where('name', $entityName)->first();
        if(is_null($translationEntity)){
            return $result;
        }

        $translationAttributeList = TranslationDal::getTranslationFields($translationEntity);
        $languageList = Language::all();

        foreach ($translationAttributeList as $translationAttribute) {
            foreach ($languageList as $language) {
                $attrName = $translationAttribute->name . '_' . $language->code;
                if(isset($entityData[$attrName])) {
                    $result[$attrName] = $entityData[$attrName];
                    unset($entityData[$attrName]);
                }
            }
        }

        return $result;
    }

    public static function generateTableQueryByBuilder(Builder $entityBuilder, bool $translateData)
    {
        return self::generateTableQueryByBuilderBase($entityBuilder, $translateData);
    }

    private static function generateTableQueryByBuilderBase(Builder $entityBuilder, bool $translateData)
    {
        $entity = $entityBuilder->getModel();
        $translationEntity = TranslationEntity::where('name', $entity->getTableName())->first();
        self::generateQueryBase($translationEntity, $entity->getTableName(), $entityBuilder, $entity->getNotTranslatableFields(), $translateData);
        return $entityBuilder;
    }

    public static function generateQuery($entityName, $entity, array $baseFields, bool $translateData)
    {
        $translationEntity = TranslationEntity::where('name', $entityName)->first();
        self::generateQueryBase($translationEntity, $entityName, $entity, $baseFields, $translateData);
    }

    public static function generateViewQuery($entityName, $entity, array $baseFields, bool $translateData, array $translateFields = null)
    {
        $translationEntity = TranslationEntity::where('name', $entityName)->first();
        $entityName .= '_ext';
        self::generateQueryBase($translationEntity, $entityName, $entity, $baseFields, $translateData, $translateFields);
    }

    private static function generateQueryBase(?TranslationEntity $translationEntity, $entityName, $entity, array $baseFields, bool $translateData, array $translateFields = null)
    {
        if (is_null($translationEntity))
            return;

        $groupExist = false;

        if(property_exists($entity->getQuery(), 'groups')){
            $groupExist = count($entity->getQuery()->groups ?? []) > 0;
        }

        if(property_exists($entity->getQuery(), 'columns')){
            $baseFields = array_merge($baseFields, $entity->getQuery()->columns ?? []);
        }

        $languageList = Language::all();
        $appSettings = SettingDal::get();
        $translationAttributeList = self::getTranslationFields($translationEntity);

        foreach ($translationAttributeList as $translationAttribute) {
            if($translateFields){
                if(!in_array($translationAttribute->name, $translateFields)){
                    continue;
                }
            }
            foreach ($languageList as $language) {
                $translationAlias = 'tn_' . $translationAttribute->name . '_' . $language->code;
                if ($language->id != $appSettings->default_language_id) {
                    self::joinTranslation($entityName, $entity, $translationAlias, $translationAttribute, $language->id);

                    $tranColumnName = $groupExist ? DB::raw('max(ifnull(' . $translationAlias . '.value, ' . $entityName . '.' . $translationAttribute->name . ')) as ' . $translationAttribute->name . '_' . $language->code) :
                        DB::raw('ifnull(' . $translationAlias . '.value, ' . $entityName . '.' . $translationAttribute->name . ') as ' . $translationAttribute->name . '_' . $language->code);

                    array_push($baseFields, $tranColumnName);
                } else {
                    $columnName = $groupExist ? 'max(' . $entityName . '.' . $translationAttribute->name . ') as ' . $entityName . '.' . $translationAttribute->name :
                        $entityName . '.' . $translationAttribute->name;

                    if ($translateData) {
                        $translationAlias = 'tn_' . $translationAttribute->name . '_c';
                        self::joinTranslation($entityName, $entity, $translationAlias, $translationAttribute, Assistant::getCurrentLanguageId());

                        $tranColumnName = $groupExist ? DB::raw('max(ifnull(' . $translationAlias . '.value, ' . $entityName . '.' . $translationAttribute->name . ')) as ' . $translationAttribute->name) :
                            DB::raw('ifnull(' . $translationAlias . '.value, ' . $entityName . '.' . $translationAttribute->name . ') as ' . $translationAttribute->name);

                        array_push($baseFields, $translateData ? $tranColumnName : $columnName);
                    } else {
                        array_push($baseFields, $columnName);
                    }
                }
            }
        }

        $entity->select($baseFields);
    }

    public static function getTranslationFields($translationEntity)
    {
        return TranslationAttribute::where('translation_entity_id', $translationEntity->id)->get();
    }

    private static function joinTranslation($entityName, $entity, $translationAlias, $translationAttribute, $languageId): void
    {
        $entity->leftJoin('translation as ' . $translationAlias, function ($join) use ($translationAlias, $entityName, $translationAttribute, $languageId) {
            $join->on($translationAlias . '.pk_value', $entityName . '.id')
                ->where($translationAlias . '.translation_attribute_id', $translationAttribute->id)
                ->where($translationAlias . '.language_id', $languageId);
        });
    }


}
