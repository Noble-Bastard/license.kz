<?php

namespace Unit;

use App\Data\DocumentTemplate\CommercialOfferDocumentManager;
use Tests\TestCase;

class CommercialOfferDocumentManagerTest extends TestCase
{
    public function testCommercialOfferDocumentGenerate(){
        $serviceIdList = array(414, 413);
        $commercialOfferDocumentManager = new CommercialOfferDocumentManager($serviceIdList);
        $fileName = $commercialOfferDocumentManager->getPdfFileName();

        $this->assertNotNull($fileName);
    }
}
