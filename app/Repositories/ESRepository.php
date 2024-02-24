<?php

namespace App\Repositories;

use App\Data\ExtraService\Model\ExtraService;
use App\Data\Translation\Dal\TranslationDal;
use App\Repositories\Interfaces\IESRepository;
use Illuminate\Database\Eloquent\Model;

class ESRepository extends BaseRepository implements IESRepository
{

  const baseField = [
    'extra_services.*'
  ];

  public function __construct(ExtraService $model)
  {
    parent::__construct($model);
  }

  public function getByCode($code): ?Model
  {
    $query = $this->query()->where('code', $code);
    TranslationDal::generateQuery($this->model->getTable(), $query, self::baseField, true);

    return $query->first();
  }
}
