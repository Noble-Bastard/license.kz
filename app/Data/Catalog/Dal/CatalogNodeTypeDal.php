<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-11
 * Time: 11:55 AM
 */

namespace App\Data\Catalog\Dal;


use App\Data\Catalog\Model\CatalogNodeType;

class CatalogNodeTypeDal
{
    public static function getList()
    {
        return CatalogNodeType::get();
    }

    public static function getListByType($typeId)
    {
        return CatalogNodeType::where('id', $typeId)->get();
    }
    public static function get($typeId)
    {
        return CatalogNodeType::where('id', $typeId)->first();
    }
}