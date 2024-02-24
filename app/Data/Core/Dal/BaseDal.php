<?php


namespace App\Data\Core\Dal;


//use App\Data\Translation\Dal\TranslationDal;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class BaseDal
{
    protected $entityClass = null;
    protected $model = null;
    protected $tableName = null;
    protected $rules = array();


    public function __construct(string $entityClass)
    {
        $this->entityClass = $entityClass;
        $this->model = $this->getEntityClass();
        $this->tableName = $this->model->getTableName();
    }

    public function get($entityId, $relationList = [], bool $translateData = false)
    {
        $columnList = $this->model->getEntityColumnList(true);

        $entity = $this->model::where($this->tableName. '.id', $entityId);
        TranslationDal::generateQuery($this->tableName, $entity, $columnList, $translateData);

        $entity = $this->setRelation($this->model, $entity, $relationList);

        return $entity->first();
    }

    public function getList($withPagination = false, $relationList = [],  bool $translateData = false)
    {
        $entityList = $this->model::from($this->tableName);
        $columnList = $this->model->getEntityColumnList(true);
        TranslationDal::generateQuery($this->tableName, $entityList, $columnList, $translateData);

        if(!empty($relationList))
            $entityList = $this->setRelation($this->model, $entityList, $relationList);

        if(in_array($this->tableName . '.created_at', $columnList)){

            $entityList = $entityList->orderBy('.created_at', 'desc');
        }

        return $withPagination ? $entityList->paginate(15) : $entityList->get();
    }


    public function set($entity_data)
    {
        try {
            DB::beginTransaction();
            $entity_data = $this->objectToArray($entity_data);
            $translationData = TranslationDal::extractEntityTranslation($this->tableName, $entity_data);

            $id = (isset($entity_data["id"])) ? $entity_data['id'] : null;

            $entity = $this->model::updateOrCreate(
                ['id' => $id],
                $entity_data
            );

            TranslationDal::setEntityTranslation($this->tableName, $entity->id, $translationData);

            DB::commit();

            return $entity;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public function delete($entityId)
    {
        $this->model::destroy($entityId);
    }

    public function getEntityClass($entityClass = null)
    {
        if (is_null($entityClass)) {
            $entityClass = $this->entityClass;
        }

        if ($entityClass != null) {
            return new $entityClass();
        } else {
            return null;
        }
    }

    private function setRelation($model, $entity, $relationList)
    {
        $entity = $entity->with($relationList);

        return $entity;
    }

    public function getByName($name)
    {
        $columnList = $this->getColumnList();
        $entity = null;
        if(in_array("name", $columnList)) {
            $entity = $this->model::where('name', $name)
                ->orderBy('id', 'asc')
                ->first();
        }
        return $entity;
    }

    public function getByDescription($name)
    {
        $columnList = $this->getColumnList();
        $entity = null;
        if(in_array("description", $columnList)) {
            $entity = $this->model::where('description', $name)
                ->orderBy('id', 'asc')
                ->first();
        }
        return $entity;
    }

    public function getByCode($code)
    {
        $columnList = $this->getColumnList();
        $entity = null;
        if(in_array("code", $columnList)) {
            $entity = $this->model::where('code', $code)
                ->orderBy('id', 'asc')
                ->first();
        }
        return $entity;
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function getTableName()
    {
        return $this->tableName;
    }


    protected function getColumnList()
    {
        return Schema::getColumnListing($this->tableName);
    }

    protected function getColumnListWithTableName()
    {
        $columns = Schema::getColumnListing($this->tableName);
        $columnsWithTableName = [];
        foreach ($columns as $column){
            array_push($columnsWithTableName,$this->tableName . "." . $column);
        }
        return $columnsWithTableName;
    }

    protected function objectToArray($entity_data)
    {
        if (is_object($entity_data))
            $entity_data = $entity_data->toArray();
        return $entity_data;
    }
}
