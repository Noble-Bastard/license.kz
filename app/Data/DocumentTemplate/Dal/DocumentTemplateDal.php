<?php

namespace App\Data\DocumentTemplate\Dal;
use App\Data\DocumentTemplate\Model\DocumentTemplate;

class DocumentTemplateDal
{

    /**
     * Get document template by Id
     *
     * @param $documentId
     * @return DocumentTemplate
     */
    public static function get($entityId)
    {
        $document = DocumentTemplate::where('id', $entityId)->firstOrFail();
        return $document;
    }


    public static function getByCountryAndTemplateType($countryId, $documentTemplateTypeId)
    {
        $entity = DocumentTemplate::where('country_id', $countryId)
            ->where('document_template_type_id', $documentTemplateTypeId)
            ->first();
        return $entity;
    }


    public static function getList()
    {
        $document = DocumentTemplate::from('document_template as dt')
            ->leftJoin('document_template_type as dtt', function ($join){
                $join->on('dtt.id','dt.document_template_type_id');
            })
            ->leftJoin('country as c', function ($join){
                $join->on('c.id','dt.country_id');
            })
            ->get(['dt.*','dtt.name as document_template_type_name', 'c.name as country_name']);
        return $document;
    }



    public static function getListByCountry($countryId)
    {
        $document = DocumentTemplate::from('document_template as dt')
            ->leftJoin('document_template_type as dtt', function ($join){
                $join->on('dtt.id','dt.document_template_type_id');
            })
            ->leftJoin('country as c', function ($join){
                $join->on('c.id','dt.country_id');
            })
            ->where('dt.country_id',$countryId)
            ->get(['dt.*','dtt.name as document_template_type_name', 'c.name as country_name']);
        return $document;
    }

    /**
     * Insert (or update)  DocumentTemplate
     *
     * @param DocumentTemplate $srcEntity
     * @return DocumentTemplate
     */
    public static function set (DocumentTemplate $srcEntity)
    {
        $entity = DocumentTemplate::where('country_id', $srcEntity->country_id)
            ->where('document_template_type_id', $srcEntity->document_template_type_id)
            ->first();

        if(is_null($entity))
        {
            $entity = new DocumentTemplate();
        }

        $entity->path = $srcEntity->path;
        $entity->name = $srcEntity->name;
        $entity->country_id = $srcEntity->country_id;
        $entity->document_template_type_id = $srcEntity->document_template_type_id;
        $entity->save();
        return $entity;
    }

    /**
     * Delete DocumentTemplate
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        DocumentTemplate::where('id', $entityId)->delete();
        return true;
    }

}
