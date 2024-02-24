<?php

namespace App\Providers;

use App\Data\Helper\Assistant;
use App\Data\Service\Dal\CityDal;
use App\Data\Service\Dal\CountryDal;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use KgBot\LaravelLocalization\Facades\ExportLocalizations;

class LocationProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['layouts.header'], function ($view)
        {
            $countryList = CountryDal::getList(false, true, false);
            $country = CountryDal::getByCode(Assistant::getCountryLocation());
            $_cityList = CityDal::getListByCountry($country->id, false, true);

            $view->with([
                '_countryList' => $countryList,
                'country' => $country,
                '_cityList' => $_cityList,
                'messages' => ExportLocalizations::export()->toArray()
            ]);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
