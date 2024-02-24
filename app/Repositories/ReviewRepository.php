<?php


namespace App\Repositories;

use App\Data\Core\Model\Review;
use App\Repositories\Interfaces\IReviewRepository;
use Illuminate\Database\Eloquent\Collection;

class ReviewRepository extends BaseRepository implements IReviewRepository
{
    public function __construct(Review $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model
            ->where('is_publish', true)
            ->with('reviewType')
            ->get();
    }

    public function getTopByType(int $count, int $reviewTypeId): Collection
    {
        return $this->model
            ->where('review_type_id', $reviewTypeId)
            ->where('is_publish', true)
            ->take($count)
            ->get();
    }
}
