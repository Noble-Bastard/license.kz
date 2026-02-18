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
use Illuminate\Support\Facades\Cache;

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
        return view('redesign.index');
    }

    public function newHome()
    {
		return view('redesign.index');
    }
  
    public function servicesNew()
    {
        $countryId = 1; // KZ
        
        // Cache categories list (10 minutes)
        $categoryList = Cache::remember('services_categories_' . $countryId, 10, function() use ($countryId) {
            return ServiceCategoryDal::getServiceCategoryWithRootCatalog(
                false,
                false,
                $countryId
            );
        });

        // Маппинг названий разделов к ID категорий по названию
        $categoryMapping = [];
        foreach($categoryList as $category) {
            $categoryName = mb_strtolower(trim($category->name));
            $categoryMapping[$categoryName] = $category->id;
            
            // Дополнительные варианты названий для сопоставления
            if (strpos($categoryName, 'лицензи') !== false) {
                $categoryMapping['лицензирование'] = $category->id;
            }
            if (strpos($categoryName, 'регистрац') !== false && strpos($categoryName, 'компани') !== false) {
                $categoryMapping['регистрация компании'] = $category->id;
            }
            if (strpos($categoryName, 'юридическ') !== false) {
                $categoryMapping['юридическое сопровождение'] = $category->id;
            }
            if (strpos($categoryName, 'бухгалтер') !== false || strpos($categoryName, 'аутсорс') !== false) {
                $categoryMapping['бухгалтерский аутсорсинг'] = $category->id;
            }
            if (strpos($categoryName, 'виза') !== false) {
                $categoryMapping['получение визы'] = $category->id;
            }
        }

        // Загружаем все категории с их каталогами (кешируем каждый каталог отдельно)
        $allCategoriesWithCatalogs = [];
        foreach($categoryList as $category) {
            try {
                // Cache each catalog separately (15 minutes)
                $rootNode = Cache::remember('service_catalog_' . $category->id, 15, function() use ($category) {
                    return \App\Data\Catalog\Dal\ServiceCategoryCatalogDal::getByServiceCategory($category->id, true);
                });
                
                if($rootNode && $rootNode->childNodeList) {
                    $allCategoriesWithCatalogs[] = [
                        'category' => $category,
                        'catalogItems' => collect($rootNode->childNodeList->where('is_visible', 1)->all())->sortBy('name')
                    ];
                }
            } catch (\Exception $e) {
                \Log::error('Error loading category ' . $category->id . ': ' . $e->getMessage());
            }
        }

        // Загружаем первую категорию по умолчанию (если есть)
        $defaultCategoryId = null;
        $defaultRootNode = null;
        if(count($categoryList) > 0) {
            $defaultCategoryId = $categoryList[0]->id;
            try {
                // Use cached catalog if available
                $defaultRootNode = Cache::remember('service_catalog_' . $defaultCategoryId, 15, function() use ($defaultCategoryId) {
                    return \App\Data\Catalog\Dal\ServiceCategoryCatalogDal::getByServiceCategory($defaultCategoryId, true);
                });
            } catch (\Exception $e) {
                \Log::error('Error loading default category: ' . $e->getMessage());
                $defaultRootNode = null;
            }
        }

        return view('services-new')
            ->with('categoryList', $categoryList)
            ->with('categoryMapping', $categoryMapping)
            ->with('defaultCategoryId', $defaultCategoryId)
            ->with('defaultRootNode', $defaultRootNode)
            ->with('allCategoriesWithCatalogs', $allCategoriesWithCatalogs);
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

        // Получаем информацию о странице и кнопке
        $sourcePage = Input::has('source_page') ? Input::get('source_page') : null;
        $buttonText = Input::has('button_text') ? Input::get('button_text') : null;
        
        // Формируем расширенный комментарий с полной информацией
        $fullComment = $comment;
        if ($sourcePage || $buttonText) {
            $fullComment .= "\n\n";
            if ($sourcePage) {
                $fullComment .= "Страница: " . $sourcePage . "\n";
            }
            if ($buttonText) {
                $fullComment .= "Кнопка: " . $buttonText . "\n";
            }
        }

        $tags = null;
        if(Input::has('tags')){
            $tags = Input::get('tags');
        }
      $roistatVisitId = array_key_exists('roistat_visit', $_COOKIE) ? $_COOKIE['roistat_visit'] : "Ğ½ĞµĞ¸Ğ·Ğ²ĞµÑ�Ñ‚Ğ½Ğ¾";
        (new AMOCrm())->callMe('license-kz-callback', $fio, $phone, $email, $fullComment, 'ĞŸĞ¾Ğ·Ğ²Ğ¾Ğ½Ğ¸Ñ‚ÑŒ Ğ¼Ğ½Ğµ', $tags, $roistatVisitId, $sourcePage, $buttonText);

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

    public function privacyPolicy()
    {
        return view('privacy-policy');
    }

    public function publicOffer()
    {
        return view('public-offer');
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

    public function constructionNew()
    {
        return view('new.pages.construction');
    }
}
