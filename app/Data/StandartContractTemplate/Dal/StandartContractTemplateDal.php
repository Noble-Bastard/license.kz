<?php

namespace App\Data\StandartContractTemplate\Dal;



use App\Data\Helper\Assistant;
use App\Data\StandartContractTemplate\Model\StandartContractTemplate;
use App\Data\StandartContractTemplate\Model\StandartContractTemplateType;

class StandartContractTemplateDal
{
    public static function get($entityId)
    {
        $document = StandartContractTemplate::where('id', $entityId)->first();
        return $document;
    }

    public static function getByCountryAndStandartContractTemplateType($countryId, $standartContractTemplateTypeId)
    {
        $entity = StandartContractTemplate::where('country_id', $countryId)
            ->where('standart_contract_template_type_id', $standartContractTemplateTypeId)
            ->first();
        return $entity;
    }

    public static function getList()
    {
        $document = StandartContractTemplate::from('standart_contract_template as sct')
            ->leftJoin('standart_contract_template_type as sctt', function ($join){
                $join->on('sctt.id','sct.standart_contract_template_type_id');
            })
            ->leftJoin('country as c', function ($join){
                $join->on('c.id','sct.country_id');
            })
            ->get(['sct.*','sctt.name as standart_contract_template_type_name', 'c.name as country_name']);
        return $document;
    }

    public static function getListByCountry($countryId)
    {
        $document = StandartContractTemplate::from('standart_contract_template as sct')
            ->leftJoin('standart_contract_template_type as sctt', function ($join){
                $join->on('sctt.id','sct.standart_contract_template_type_id');
            })
            ->leftJoin('country as c', function ($join){
                $join->on('c.id','sct.country_id');
            })
            ->where('sct.country_id',$countryId)
            ->get(['sct.*','sctt.name as standart_contract_template_type_name', 'c.name as country_name']);
        return $document;
    }

    public static function set (StandartContractTemplate $srcEntity)
    {
        $srcEntity->save();
        return $srcEntity;
    }

    public static function delete($entityId)
    {
        StandartContractTemplate::where('id', $entityId)->delete();
        return true;
    }

    public static function getListByTypeAndCurrentCountry($standartContractTemplateTypeId)
    {
        $document = StandartContractTemplate::from('standart_contract_template as sct')
            ->leftJoin('standart_contract_template_type as sctt', function ($join){
                $join->on('sctt.id','sct.standart_contract_template_type_id');
            })
            ->leftJoin('country as c', function ($join){
                $join->on('c.id','sct.country_id');
            })
            ->where('sct.standart_contract_template_type_id',$standartContractTemplateTypeId)
            ->where('sct.country_id', Assistant::getCurrentLanguageId())
            ->get(['sct.*','sctt.name as standart_contract_template_type_name', 'c.name as country_name']);
        return $document;
    }
}
