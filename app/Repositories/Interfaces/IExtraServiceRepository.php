<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Model;

interface IExtraServiceRepository extends IRepository
{
  public function getByCode($code): ?Model;
}
