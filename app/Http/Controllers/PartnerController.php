<?php


namespace App\Http\Controllers;

use App\Data\Article\Dal\ArticleDal;
use App\Data\Core\Dal\ProfileDal;
use App\Data\Core\Model\ProfilePartner;
use App\Data\ExternalPartner\Dal\ExternalPartnerDal;
use App\Data\Helper\FilePathHelper;
use App\Data\Helper\SocialTypeList;
use App\Data\Partner\Dal\PartnerDal;
use App\Data\Partner\Dal\PartnerSocialDal;
use App\Data\Partner\Model\Partner;
use App\Data\Partner\Model\PartnerSocial;
use App\Data\Service\Dal\CityDal;
use App\Data\Service\Dal\CountryDal;
use App\Data\Service\Model\Country;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    private $validateRule = [
        'fio' => 'required|string|max:1024',
        'position' => 'required|string|max:1024',
        'email' => 'required|string|max:128',
        'phone' => 'required|string|max:128',
        'company_name' => 'required|string|max:512',
        'company_site' => 'required|string|max:128',
        'company_phone' => 'required|string|max:128',
        'company_activity' => 'required|string|max:2048',
        'company_location' => 'required|string|max:512',
        'company_additionally' => 'max:2048',
        'company_facebook' => 'max:128',
        'company_instagram' => 'max:128',
        'company_linkedln' => 'max:128',
    ];

    public function index()
    {
        $partnerList = (new ExternalPartnerDal())->getList(true);

        return view('partner.index')
            ->with('partnerList', $partnerList);
    }

    public function create()
    {
        return view('partner.form');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), $this->validateRule)->validate();

        $partner = new Partner();
        $partner->fio = Input::get('fio');
        $partner->position = Input::get('position');
        $partner->email = Input::get('email');
        $partner->phone = Input::get('phone');
        $partner->company_name = Input::get('company_name');
        $partner->company_site = Input::get('company_site');
        $partner->company_phone = Input::get('company_phone');
        $partner->company_activity = Input::get('company_activity');
        $partner->company_location = Input::get('company_location');
        $partner->company_additionally = Input::get('company_additionally');

        if(!str_contains($partner->company_site, 'http://')){
            $partner->company_site = 'http://' . $partner->company_site;
        }

        if(!is_null($request->file('company_logo'))) {
            $path = $request->file('company_logo')->store(FilePathHelper::getPartnerFormPath());
            $partner->company_logo = $path;
        }

        $partner = PartnerDal::set($partner);

        //career_form_social
        if(!is_null(Input::get('company_facebook'))) {
            $partnerSocial = new PartnerSocial();
            $partnerSocial->partner_form_id = $partner->id;
            $partnerSocial->social_type_id = SocialTypeList::FACEBOOK;
            $partnerSocial->value = Input::get('company_facebook');
            PartnerSocialDal::set($partnerSocial);
        }

        if(!is_null(Input::get('company_instagram'))) {
            $partnerSocial = new PartnerSocial();
            $partnerSocial->partner_form_id = $partner->id;
            $partnerSocial->social_type_id = SocialTypeList::INSTAGRAM;
            $partnerSocial->value = Input::get('company_instagram');
            PartnerSocialDal::set($partnerSocial);
        }

        if(!is_null(Input::get('company_linkedln'))) {
            $partnerSocial = new PartnerSocial();
            $partnerSocial->partner_form_id = $partner->id;
            $partnerSocial->social_type_id = SocialTypeList::LINKEDIN;
            $partnerSocial->value = Input::get('company_linkedln');
            PartnerSocialDal::set($partnerSocial);
        }

        Session::flash('success_save', trans('messages.partner_form.success_save'));
        return redirect(route('new-partners'));
    }

    public function summary($id)
    {
        $partner = ProfileDal::getPartnerDataById($id, true);

        if(!is_null($partner->profile->city_id)) {
            $partner->city = CityDal::get($partner->profile->city_id, true);
            $partner->country = CountryDal::get($partner->city->country_id, true);
        }

        return view('partner.summary')
            ->with('partner', $partner);
    }
}