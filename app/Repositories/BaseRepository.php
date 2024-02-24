<?php

namespace App\Repositories;

use App\Models\StorageFile;
use App\Models\Translation;
use App\Repositories\Interfaces\IRepository;
use App\Traits\Storable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class BaseRepository implements IRepository
{
    protected $model;


    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    protected function query(): Builder
    {
        $query = $this->model->query();
        return $query;
    }

    public function find($id): ?Model
    {
        $query = $this->model->query();
        return $query->find($id);
    }

    public function all(): Collection
    {
        $model = $this->model;
        return $model->get();
    }

    public function create(array $attributes): Model
    {
        $modelAttributes = $this->getModelAttributes($attributes);
        $entity = $this->model->query()->create($modelAttributes);
        return $this->find($entity->id);
    }

    public function update($id, array $attributes): Model
    {
        $modelAttributes = $this->getModelAttributes($attributes);
        $entity =  $this->model->query()->find($id);
        $entity->fill($modelAttributes);
        $entity->save();
        return $this->find($entity->id);
    }

    public function delete($id) : int
    {
        $entity = $this->find($id);

        if(!$entity)
            return 0;

        return $entity::destroy($id);
    }

    private function getModelAttributes(array $attributes): array
    {
        $modelColumns = $this->getModelColumns();
        $filteredAttributes = array_filter(
            $attributes,
            function ($key) use ($modelColumns) {
                return in_array($key, $modelColumns);
            },
            ARRAY_FILTER_USE_KEY
        );
        return $filteredAttributes;
    }

    private function getModelColumns(): array
    {
        return Schema::getColumnListing($this->model->getTable());
    }

}
