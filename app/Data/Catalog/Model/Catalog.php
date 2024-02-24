<?php

namespace App\Data\Catalog\Model;

use App\Data\Core\Model\BaseTableModel;
use App\Data\Service\Model\ServiceType;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Company\Model\Catalog
 *
 * @property int $id
 * @property int catalog_parent_id
 * @property int catalog_node_type_id
 * @property string pretty_url
 * @property string name
 * @property string description
 * @property string image_path
 * @property int order_no
 * @property bool is_visible
 * @property bool is_blank_page
 * @property string seo_title
 * @property string seo_description
 * @property string seo_keys
 *
 * @mixin \Eloquent
 */
class Catalog extends BaseTableModel
{
    public function __construct()
    {
        parent::__construct(
            'catalog',
            false
        );
    }

    public function nodeType()
    {
        return $this->hasOne('App\Data\Catalog\Model\CatalogNodeType', 'id', 'catalog_node_type_id');
    }

    public function childNodeList()
    {
        $relation = $this->hasMany($this, 'catalog_parent_id', 'id')->orderBy('order_no')->with('serviceCatalogList');

        TranslationDal::generateQuery($this->getTableName(), $relation, $this->getEntityColumnList(true), true);

        return $relation;
    }

    public function parentNode()
    {
        return $this->hasOne($this, 'id', 'catalog_parent_id');
    }
    public function recursiveParent() {
        return $this->parentNode()->with('recursiveParent');
        //It seems this is recursive
    }

    public function serviceCatalogList()
    {
        $relation = $this->hasMany(ServiceCatalog::class, 'catalog_id', 'id')->with('service.serviceType');

        $serviceCatalog = new ServiceCatalog();
        TranslationDal::generateQuery($serviceCatalog->getTableName(), $relation, $serviceCatalog->getEntityColumnList(true), true);

        return $relation;
    }

    public function existServiceCatalog()
    {
        $serviceCatalog = $this->serviceCatalogList;
        return sizeof($serviceCatalog);
    }

    public function children()
    {
        return $this->hasMany($this, 'catalog_parent_id', 'id');
    }

    public function recursiveChildren()
    {
        return $this->children()->with('recursiveChildren');
        //It seems this is recursive
    }
}
