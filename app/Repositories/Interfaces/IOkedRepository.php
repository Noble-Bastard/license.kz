<?php
namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;

interface IOkedRepository extends IRepository
{
    public function search(string $value): Collection;
}
