<?php
namespace App\Http\Controllers;

use App\Repositories\Interfaces\IReviewRepository;

class ReviewController extends Controller
{
    private $reviewRepository;

    /**
     * OkedController constructor.
     * @param IReviewRepository $reviewRepository
     */
    public function __construct(IReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function index()
    {
        $reviewList = $this->reviewRepository->all();
        return view('review.index')
            ->with('reviewList', $reviewList);

    }

    public function indexRedesign()
    {
        $reviewList = $this->reviewRepository->all();
        return view('reviews-new')
            ->with('reviewList', $reviewList);
    }

    public function indexNew()
    {
        $reviewList = $this->reviewRepository->all();
        return view('new.pages.reviews')
            ->with('reviewList', $reviewList);

    }
}
