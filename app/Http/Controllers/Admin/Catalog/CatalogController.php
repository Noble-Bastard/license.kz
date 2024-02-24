<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-08
 * Time: 4:37 PM
 */

namespace App\Http\Controllers\Admin\Catalog;


use App\Data\Catalog\Dal\CatalogDal;
use App\Data\Catalog\Dal\CatalogNodeTypeDal;
use App\Data\Catalog\Dal\ServiceCategoryCatalogDal;
use App\Data\Catalog\Model\Catalog;
use App\Data\Catalog\Model\CatalogNodeType;
use App\Data\Helper\FilePathHelper;
use App\Data\Helper\MoveTypeList;
use App\Data\Service\Dal\CountryDal;
use App\Data\Service\Dal\ServiceDal;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CatalogController
{
    private $entityName = 'catalog';

    private $validateRule = [
        'parentId' => 'required|numeric',
        'type' => 'required|numeric',
        'name' => 'required|string:max1024'
    ];

    public function index()
    {
        $countryList = CountryDal::getList(false, true);

        return view('admin.catalog.index')
            ->with('countryList', $countryList);
    }

    public function getByServiceCategory($serviceCategoryId)
    {
        $rootNode = ServiceCategoryCatalogDal::getByServiceCategory($serviceCategoryId);

        $result = new \stdClass();
        $result->nodeList = CatalogDal::geNodeListByParentId($rootNode->id, true);
        $result->rootNode = $rootNode;

        return response()->json($result);
    }

    public function getByParentId($parentId)
    {
        $entityList = CatalogDal::geNodeListByParentId($parentId, true);

        return response()->json($entityList);
    }

    public function getNodeTypeList($serviceCategoryId, $parentNodeId)
    {
        if(is_null($parentNodeId)){
            $rootNode = ServiceCategoryCatalogDal::getByServiceCategory($serviceCategoryId);

            $parentNodeId = $rootNode->id;
        }

        $nodeList = CatalogDal::geNodeListByParentId($parentNodeId, true);
        if(sizeof($nodeList) > 0){
            $entityList = CatalogNodeTypeDal::getListByType($nodeList[0]->catalog_node_type_id);
        } else {
            $entityList = CatalogNodeTypeDal::getList();
        }

        return response()->json($entityList);
    }

    public function changeNodeType()
    {
        $parentNodeId = Input::get('parentNodeId');
        $typeId = Input::get('typeId');

        CatalogDal::changeChildNodeType($parentNodeId, $typeId);

        return $this->getByParentId($parentNodeId);
    }

    public function store(Request $request){
        Validator::make($request->all(), $this->validateRule)->validate();

        $result = $this->set($request, false);

        return $result;
    }

    public function update(Request $request){
        $rule = $this->validateRule;
//        unset($rule['type']);

        Validator::make($request->all(), $rule)->validate();

        $result = $this->set($request, true);

        return $result;
    }

    public function getServiceList()
    {
        $countryId = Input::get('countryId');
        $serviceCategoryId = Input::get('serviceCategoryId');
        $serviceList = ServiceDal::getServiceListByServiceCategoryAndCountry($serviceCategoryId, $countryId, true);

        return response()->json($serviceList);
    }

    public function assignService()
    {
        $catalogNodeId = Input::get('nodeId');
        $serviceId = Input::get('serviceId');
        CatalogDal::assignService($catalogNodeId, $serviceId);

        return response()->json(CatalogDal::get($catalogNodeId, true));
    }

    public function unassignService()
    {
        $serviceCatalogId = Input::get('serviceCatalogId');
        $catalogNodeId = Input::get('nodeId');
        CatalogDal::unassignService($serviceCatalogId);

        return response()->json(CatalogDal::get($catalogNodeId, true));
    }

    private function set(Request $request, bool $id = false){
        $entity = new Catalog();

        if($id){
            $entity->id = Input::get('id');
        }

        $entity->name = Input::get('name');
        $entity->description = Input::get('description');
        $entity->catalog_parent_id = Input::get('parentId');
        $entity->catalog_node_type_id = Input::get('type');
        $entity->pretty_url = Input::get('pretty_url');
        $entity->seo_title = Input::get('seo_title');
        $entity->seo_description = Input::get('seo_description');
        $entity->seo_keys = Input::get('seo_keys');

        TranslationDal::extendEntityAttribute($this->entityName, $entity);

        $entity = CatalogDal::set($entity);

        if(!is_null($request->file('photo'))){
            $path = $request->file('photo')->store(FilePathHelper::getCatalogFormPath());

            CatalogDal::setPhoto($entity->id, $path);
        }

        return response()->json(CatalogDal::get($entity->id));
    }

    public function delete()
    {
        CatalogDal::delete(Input::get('entityId'));
    }

    public function moveUp($nodeId){
        return $this->move($nodeId, MoveTypeList::UP);
    }
    public function moveDown($nodeId){
        return $this->move($nodeId, MoveTypeList::DOWN);
    }

    private function move($nodeId, $moveType)
    {
        CatalogDal::move($nodeId, $moveType);

        $node = CatalogDal::get($nodeId);

        return $this->getByParentId($node->catalog_parent_id);
    }

    public function toggleVisibility($nodeId)
    {
        CatalogDal::toggleVisibility($nodeId);
        return response()->json(CatalogDal::get($nodeId));
    }

    public function toggleBlankPage($nodeId)
    {
        CatalogDal::toggleBlankPage($nodeId);
        return response()->json(CatalogDal::get($nodeId));
    }
}