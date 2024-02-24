<?php

namespace App\Data\DocumentTemplate\Dal;

use App\Data\DocumentTemplate\Model\DocumentTemplateType;

class DocumentTemplateTypeDal
{

    public static function get($entityId)
    {
        $document = DocumentTemplateType::where('id', $entityId)->firstOrFail();
        return $document;
    }

    public static function getList()
    {
        $document = DocumentTemplateType::get();
        return $document;
    }


}
