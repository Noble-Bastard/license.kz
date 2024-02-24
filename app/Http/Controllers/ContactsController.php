<?php

namespace App\Http\Controllers;

use App\Data\Article\Dal\ArticleDal;
use App\Data\Company\Dal\CompanyDal;
use App\Data\Service\Dal\CityDal;
use Illuminate\Http\Request;
use App\Data\Helper\Assistant;
use App\Data\Service\Dal\CountryDal;
use App\Data\Article\Model\Article;
class ContactsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
       /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countryList = CountryDal::getList(false, true, false);

        foreach ($countryList as $country){
            $country->company_address = CompanyDal::getListByCountry($country->id, false);
        }

        return view('contacts')
            ->with('countryList', $countryList);
    }
}
