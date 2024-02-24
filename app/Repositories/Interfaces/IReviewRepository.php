<?php
namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;

interface IReviewRepository extends IRepository
{
    public function getTopByType(int $count, int $reviewTypeId): Collection;
}
