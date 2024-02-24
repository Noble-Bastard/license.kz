<?php

namespace Tests\Unit;

use App\Data\Service\Dal\CityDal;
use App\Data\Service\Dal\CountryDal;
use \App\Services\Countries\CountriesRest;
use Tests\TestCase;

class CountriesTest extends TestCase
{
    public function testGetByNameNotNull(){
        $this->assertNotNull(CountriesRest::getByName("Казахстан"));
    }

    public function testGetByNameNull(){
        $this->assertNull(CountriesRest::getByName("Казах"));
    }

    public function testCountryExist(){
        $this->assertNull(CountryDal::getByName("Киргизия"));
    }

    public function testCityExist(){
        $this->assertNotNull(CityDal::getByName("Актобе", 1));
    }
}
