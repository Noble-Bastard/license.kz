<?php


namespace App\Data\Interactor;


use App\Data\Core\Dal\SettingDal;
use App\Data\Core\Model\BaseTableModel;
use App\Data\Translation\Dal\TranslationDal;
use App\Data\Translation\Model\Language;
use App\Data\Translation\Model\TranslationEntity;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class RequestManager
{

    public static function validate($data, $rules = null)
    {
        Validator::make($data, $rules)->validate();
    }


    public static function getEntity($entity)
    {
        $entity_data = array();
        $columnList = $entity->getEntityColumnList();

        foreach ($columnList as $column)
            $entity_data = Arr::add($entity_data, $column, Request::input($column));

        return $entity_data;
    }

    public static function extendEntityToTranslate($translationAttributeList, &$entity)
    {
        $languageList = Language::all();
        $appSettings = SettingDal::get();

        foreach ($translationAttributeList as $translationAttribute) {
            foreach ($languageList as $language) {
                $attrName = $translationAttribute->name;
                if ($language->id != $appSettings->default_language_id) {
                    $attrName .= '_' . $language->code;
                }

                $entity[$attrName] = Request::input($attrName);
            }
        }
    }

    public static function extendEntityAttributeToTranslate(string $entityName, &$entity)
    {
        $translationEntity = TranslationEntity::where('name', $entityName)->first();

        if (!is_null($translationEntity)) {
            $translationAttributeList = TranslationDal::getTranslationFields($translationEntity);

            RequestManager::extendEntityToTranslate($translationAttributeList, $entity);
        }
    }
}
