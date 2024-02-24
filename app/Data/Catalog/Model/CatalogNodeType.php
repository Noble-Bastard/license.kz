<?php

namespace App\Data\Catalog\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Catalog\Model\CatalogNodeType
 *
 * @property int $id
 * @property string value
 * @property bool isPhotoExist
 *
 * @mixin \Eloquent
 */
class CatalogNodeType extends Model
{
    protected $table = 'catalog_node_type';
    public $timestamps = false;

    protected $fillable = [
        'value',
        'isPhotoExist'
    ];
    protected $guarded = ['id'];
}
