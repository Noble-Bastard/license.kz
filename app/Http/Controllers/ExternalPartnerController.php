<?php


namespace App\Http\Controllers;

use App\Data\ExternalPartner\Dal\ExternalPartnerDal;
use App\Data\Helper\ReviewTypeList;
use App\Repositories\Interfaces\IReviewRepository;

class ExternalPartnerController extends Controller
{
    private $reviewRepository;

    public function __construct(IReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function index()
    {
        $partnerList = (new ExternalPartnerDal())->getList(true);

        return view('partner.index')
            ->with('partnerList', $partnerList);
    }

    public function indexNew()
    {
        $partnerList = (new ExternalPartnerDal())->getList(true);

        $reviewList = $this->reviewRepository->getTopByType(3, ReviewTypeList::Video);

        return view('new.pages.partners')
            ->with('partnerList', $partnerList)
            ->with('reviewList', $reviewList);
    }

    public function info($id)
    {
        $partner = (new ExternalPartnerDal())->get($id, true);

        return view('partner._partnerInfo')
            ->with('partner', $partner);
    }
}
