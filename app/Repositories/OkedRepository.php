<?php


namespace App\Repositories;

use App\Data\Core\Model\Oked;
use App\Repositories\Interfaces\IOkedRepository;
use Illuminate\Database\Eloquent\Collection;

class OkedRepository extends BaseRepository implements IOkedRepository
{
    public function __construct(Oked $model)
    {
        parent::__construct($model);
    }

    public function search(string $value): Collection
    {
        return $this->model
            ->where('code', 'like', strtoupper('%'.$value.'%'))
            ->orWhere('description', 'like', strtoupper('%'.$value.'%'))
            ->get();
    }

}
