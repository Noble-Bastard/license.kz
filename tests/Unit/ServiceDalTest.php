<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-07
 * Time: 2:27 PM
 */

namespace Tests\Unit;


use App\Data\Service\Dal\ServiceDal;
use Tests\TestCase;

class ServiceDalTest extends TestCase
{
    public function testGetById()
    {
        $entityId = 1;
        $result = ServiceDal::get($entityId);
        $this->assertFalse(is_null($result));
    }

    public function testGetServiceListByServiceCategoryAndCountry()
    {
        $entityId = 1;
        $countryId = 1;
        $result = ServiceDal::getServiceListByServiceCategoryAndCountry($entityId, $countryId);
        $this->assertFalse(is_null($result));
    }

    public function testGetListWithPaginate()
    {
        $result = ServiceDal::getList(true);
        $this->assertFalse(is_null($result));
    }

    public function testGetListWithOutPaginate()
    {
        $result = ServiceDal::getList(false);
        $this->assertFalse(is_null($result));
    }

    public function testGetListWithSearchText()
    {
        $result = ServiceDal::getList(false, null, null, 'Регистрации');
        $this->assertFalse(is_null($result));
    }

    public function testGetServiceStatusList()
    {
        $result = ServiceDal::getServiceStatusList();
        $this->assertFalse(is_null($result));
    }
}