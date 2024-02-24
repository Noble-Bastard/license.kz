<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface IESRepository extends IRepository
{
  public function getByCode($code): ?Model;
}
