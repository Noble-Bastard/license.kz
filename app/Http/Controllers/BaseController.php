<?php

namespace App\Http\Controllers;

use App\Data\Interactor\RequestManager;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $dalObject;
    protected $indexView;

    public function __construct($dalObject, string $indexView)
    {
        $this->dalObject = new $dalObject;
        $this->indexView = $indexView;
    }

    public function index()
    {
        return view($this->indexView);
    }

    public function getList(bool $withPagination = false, array $relationList = [])
    {
        return response()->json($this->dalObject->getList($withPagination, $relationList));
    }

    public function set(Request $request)
    {
        $this->validateData($request);
        $this->setData();
        return response()->json('1');
    }

    public function delete($id)
    {
        $this->dalObject->delete($id);
        return response()->json('1');
    }

    protected function validateData(Request $request): void
    {
        RequestManager::validate($request->all(), $this->dalObject->getRules());
    }

    protected function getEntity(): array
    {
        $entity =  RequestManager::getEntity($this->dalObject->getEntityClass());
        RequestManager::extendEntityAttributeToTranslate($this->dalObject->getTableName(), $entity);
        return $entity;
    }

    protected function setData()
    {
        return $this->dalObject->set($this->getEntity());
    }

}
