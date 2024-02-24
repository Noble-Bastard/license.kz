<?php

namespace App\Http\Controllers;

use App\Data\Helper\Assistant;
use App\Data\Service\Dal\CountryDal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class HelperController extends Controller
{
    public function setLocationCountry()
    {
        Assistant::setCountryCode(Input::get('location_country_code'));

        return redirect()->back();
    }

    public function setLocale()
    {
        Assistant::setLocale(Input::get('locale'));

        return redirect()->back();
    }

}
