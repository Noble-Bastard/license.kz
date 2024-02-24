<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-11
 * Time: 12:01 PM
 */

namespace Tests\Unit;

use App\Data\StandartContractTemplate\Dal\StandartContractTemplateTypeDal;
use App\Data\StandartContractTemplate\Model\StandartContractTemplateType;

use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class StandartContractTemplateTypeDataTest extends TestCase
{

    public function setUp() : void
    {
        parent::setUp();
        DB::beginTransaction();
    }

    public function testSetSampleNameShouldGetSampleName()
    {
        $entity = new StandartContractTemplateType();
        $entity->name = 'sample';
        $entity->name_en = 'sample_en';
        $newEntity = StandartContractTemplateTypeDal::set($entity);
        self::assertEquals($newEntity->name, $entity->name);
        self::assertEquals($newEntity->name_en, $entity->name_en);
    }

    public function tearDown() : void
    {
        DB::rollback();
        parent::tearDown();
    }

}