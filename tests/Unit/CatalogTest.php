<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-11
 * Time: 12:01 PM
 */

namespace Tests\Unit;


use App\Data\Catalog\Dal\CatalogDal;
use App\Http\Controllers\Admin\Catalog\CatalogController;
use Tests\TestCase;

class CatalogTest extends TestCase
{
    public function testGetNodeTypeListNull()
    {
        $catalogController = new CatalogController();
        $result = $catalogController->getNodeTypeList(null, 2);
        $this->assertTrue($result->getStatusCode() === 200);
    }

    public function testGetNextOrderNo()
    {
        $result = CatalogDal::getNextOrderNo(2);
        $this->assertTrue($result >= 0);
    }
}