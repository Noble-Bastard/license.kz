<?php

namespace App\Data\Core\Model;

use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;


class BaseTableModel extends Model
{
    protected $table;
    public $timestamps;

    protected $guarded = ['id'];

    function __construct($table, $timestamps)
    {
        parent::__construct();
        $this->table = $table;
        $this->timestamps = $timestamps;
    }

    public function getTableName(): ? string
    {
        return $this->getTable();
    }

    public function getFields()
    {
        $fillableFields = $this->getFillable();
        $guardedFields = $this->getGuarded();
        return  array_unique(array_merge($fillableFields, $guardedFields));
    }

    public function getNotTranslatableFields()
    {
        $fields = $this->getFields();
        $tableName = $this->getTableName();
        $translationFields = TranslationDal::getTranslationFieldsByTableName($tableName);
        $notTranslatableFields = array();
        foreach ($fields as $field ){
            if(!$translationFields->contains('name',$field))
                array_push($notTranslatableFields, sprintf("%s.%s",$tableName,$field));
        }
        return $notTranslatableFields;
    }

    public function getBaseQuery()
    {
        return $this::from($this->getTableName());
    }


    public function getEntityColumnList(bool $withAlias = false, $entityName = null)
    {
        $columnList = Schema::getColumnListing($this->getTableName());

        if ($withAlias) {
            if(is_null($entityName)){
                $entityName = $this->getTableName();
            }
            for ($i = 0; $i < sizeof($columnList); $i++) {
                $columnList[$i] = $entityName . '.' . $columnList[$i];
            }
        }

        return $columnList;
    }
}
