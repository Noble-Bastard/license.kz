<?php


namespace App\Repositories;


use App\Repositories\Interfaces\IRepository;
use Illuminate\Database\Eloquent\Model;

interface IExtraServiceRepository extends IRepository
{
  public function getByCode($code): ?Model;
}
