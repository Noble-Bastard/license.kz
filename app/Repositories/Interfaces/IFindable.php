<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IFindable
{
    public function all(): Collection;
    public function find($id): ?Model;
}
