<?php

namespace App\Http\Controllers;

use App\Data\Catalog\Model\Catalog;
use App\Data\Core\Dal\NewsDal;
use App\Data\Core\Model\News;
use App\Data\Core\Model\NewsTag;
use App\Data\ExternalPartner\Dal\ExternalPartnerDal;
use App\Data\Helper\ReviewTypeList;
use App\Data\Notify\Dal\AMOCrm;
use App\Data\Service\Dal\NewPotentialClientDal;
use App\Data\Service\Dal\ServiceCategoryDal;
use App\Data\Service\Dal\ServiceDal;
use App\Data\Service\Model\NewPotentialClient;
use App\Data\Service\Model\NewPotentialClientService;
use App\Repositories\Interfaces\IReviewRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    private $reviewRepository;

    public function __construct(IReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countryId = 1; //KZ

        $newsList = NewsDal::getTopActualNews(3);
        $categoryList = ServiceCategoryDal::getServiceCategoryWithoutSystemList(
            false,
            false,
            $countryId
        );
        $partnerList =  (new ExternalPartnerDal())->getList(true);
        $reviewList = $this->reviewRepository->getTopByType(5, ReviewTypeList::Video);

        return view('home')
            ->with('categoryList', $categoryList)
            ->with('newsList', $newsList)
            ->with('reviewList', $reviewList)
            ->with('partnerList', $partnerList);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexNew()
    {
        $countryId = 1; //KZ

        $newsList = NewsDal::getTopActualNews(4);
        $categoryList = ServiceCategoryDal::getServiceCategoryWithRootCatalog(
            false,
            false,
            $countryId
        );
        $partnerList =  (new ExternalPartnerDal())->getList(true);
        $reviewList = $this->reviewRepository->all();

        $topCategoryList = ServiceCategoryDal::getServiceCategoryWithRootCatalog(
            false,
            false,
            $countryId,
            true,
            true
        );

        return view('new.index')
            ->with('categoryList', $categoryList)
            ->with('topCategoryList', $topCategoryList)
            ->with('newsList', $newsList)
            ->with('reviewList', $reviewList)
            ->with('partnerList', $partnerList);
    }

    public function newHome()
    {
		return view('current.index');
    }
  
    public function servicesNew()
    {
        return view('new.pages.services');
    }

    public function callMe()
    {
        $phone = '';
        if(Input::has('phone')) {
            $phone = Input::get('phone');
        }
        $fio = '';
        if(Input::has('fio')){
            $fio = Input::get('fio');
        }
        if(Input::has('name')){
          $fio = Input::get('name');
        }
        $email = '';
        if(Input::has('email')){
            $email = Input::get('email');
        }
        $comment = null;
        if(Input::has('comment')){
            $comment = Input::get('comment');
        }

        $tags = null;
        if(Input::has('tags')){
            $tags = Input::get('tags');
        }
      $roistatVisitId = array_key_exists('roistat_visit', $_COOKIE) ? $_COOKIE['roistat_visit'] : "Ğ½ĞµĞ¸Ğ·Ğ²ĞµÑ�Ñ‚Ğ½Ğ¾";
        (new AMOCrm())->callMe('license-kz-callback', $fio, $phone, $email, $comment, 'ĞŸĞ¾Ğ·Ğ²Ğ¾Ğ½Ğ¸Ñ‚ÑŒ Ğ¼Ğ½Ğµ', $tags, $roistatVisitId);

        return response()->json("1");
    }

    public function becomePartner()
    {
        $name = Input::get('name');
        $companyName = Input::get('companyName');
        $bin = Input::get('bin');
        $email = Input::get('email');
        $services = Input::get('services');
        $phone = Input::get('phone');

        $comment = "Ğ¡Ñ‚Ğ°Ñ‚ÑŒ Ğ¿Ğ°Ñ€Ñ‚Ğ½ĞµÑ€Ğ¾Ğ¼. Ğ�Ğ°Ğ·Ğ²Ğ°Ğ½Ğ¸Ğµ ĞºĞ¾Ğ¼Ğ¿Ğ°Ğ½Ğ¸Ğ¸: {$companyName}. Ğ‘Ğ˜Ğ�: {$bin}. ĞŸÑ€ĞµĞ´Ğ»Ğ°Ğ³Ğ°ĞµĞ¼Ñ‹Ğµ ÑƒÑ�Ğ»ÑƒĞ³Ğ¸: {$services}.";
        $roistatVisitId = array_key_exists('roistat_visit', $_COOKIE) ? $_COOKIE['roistat_visit'] : "Ğ½ĞµĞ¸Ğ·Ğ²ĞµÑ�Ñ‚Ğ½Ğ¾";
        (new AMOCrm())->callMe('license-kz-callback', $name, $phone, $email, $comment, 'Ğ¡Ñ‚Ğ°Ñ‚ÑŒ Ğ¿Ğ°Ñ€Ñ‚Ğ½ĞµÑ€Ğ¾Ğ¼', null, $roistatVisitId);

        return response()->json("1");
    }

    public function  newPotentialClient(Request $request)
    {
        $request->validate([
            'commercialOfferName' => 'string|max:255',
            'commercialOfferEmail' => 'required|email|max:255',
            'commercialOfferPhone' => 'required|string|max:20',
        ]);


        parse_str(parse_url($request->get('setPaymentType'), PHP_URL_QUERY), $output);

        $name = $request->get('commercialOfferName');
        $phone = $request->get('commercialOfferPhone');
        $email = $request->get('commercialOfferEmail');

        $params = [
            'name' => $name,
            'phone' => $phone,
            'serviceIdList' => explode(',', $output['serviceList']),
            'emailToSend' => $email
        ];

        $comment = '';
        foreach ($params['serviceIdList'] as $serviceId){
            $service = ServiceDal::get($serviceId);
            $comment .= $service->name . ' | ';
        }

      $roistatVisitId = array_key_exists('roistat_visit', $_COOKIE) ? $_COOKIE['roistat_visit'] : "Ğ½ĞµĞ¸Ğ·Ğ²ĞµÑ�Ñ‚Ğ½Ğ¾";
        (new AMOCrm())->callMe('license-kz-callback', $name, $phone, $email, $comment, 'ĞŸĞ¾Ğ·Ğ²Ğ¾Ğ½Ğ¸Ñ‚ÑŒ Ğ¼Ğ½Ğµ', null, $roistatVisitId);

        if(config('app.env') != 'local') {
            (new ServiceDal())->sendCommercialOffer($params);
        }

        $newPotentialClientDal = new NewPotentialClientDal();

        $newPotentialClient = new NewPotentialClient();
        $newPotentialClient->name = $params['name'];
        $newPotentialClient->phone = $params['phone'];
        $newPotentialClient->email = $params['emailToSend'];
        $newPotentialClient->service_id = '';
        $newPotentialClient = $newPotentialClientDal->set($newPotentialClient);
        foreach ($params['serviceIdList'] as $serviceId){
            $newPotentialClientService = new NewPotentialClientService();
            $newPotentialClientService->new_potential_client_id = $newPotentialClient->id;
            $newPotentialClientService->service_id = $serviceId;
            $newPotentialClientService->save();
        }

        session()->forget('setPaymentType');
        return redirect(route('createPotentialClientSuccess'));
    }

    public function createPotentialClientSuccess()
    {
        return view('Client.newPotentialClient');
    }

    public function offer()
    {
        return view('offer');
    }

    public function fixTagList()
    {
        $newsList = News::where('is_actual', 1)->get();
        foreach ($newsList as $news){
            $tagList = explode('#', $news->tags);
            foreach ($tagList as $tag){
                if($tag) {
                    $tagVal = ltrim(rtrim($tag));
                    $newsTag = NewsTag::firstOrNew([
                        'name' => $tagVal,
                        'news_content_type_id' => $news->news_content_type_id,
                        'language_id' => $news->language_id
                    ]);

                    $newsTag->save();
                }
            }
        }
    }

    public function testMail()
    {
        NewsDal::distributionNotify(281);
    }

    public function generatePrettyUrl()
    {
        $catalogList = Catalog::all();
        foreach ($catalogList as $catalog){
            if(is_null($catalog->pretty_url)){
                try {
                    $catalog->pretty_url = \Illuminate\Support\Str::slug($catalog->name, "_");
                    $catalog->save();
                } catch (\Exception $e){

                }
            }
        }
    }

    public function check_partner()
    {
        return view('checkPartner');
    }
}
