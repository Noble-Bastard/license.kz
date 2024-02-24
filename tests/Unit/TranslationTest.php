<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-11
 * Time: 12:01 PM
 */

namespace Tests\Unit;

use App\Data\StandartContractTemplate\Model\StandartContractTemplateType;

use App\Data\Translation\Dal\TranslationDal;
use Tests\TestCase;

class TranslationTest extends TestCase
{

    public function testGetTranslationAttributesByStandartContractTemplateTypeShouldContainName()
    {
        $translationDal = new TranslationDal();
        $translationAttributes = $translationDal->getTranslationFieldsByTableName('standart_contract_template_type');
        $this->assertTrue($translationAttributes->contains('name', 'name'));
    }

    public function testGenerateTableQueryByStandartContractTemplateTypeShouldContainNameTranslation()
    {
        $translationDal = new TranslationDal();
        $entityQuery = $translationDal->generateTableQueryByBuilder((new StandartContractTemplateType())->getBaseQuery(), true);
        $entities = $entityQuery->get();
        $this->assertTrue(isset($entities->first()->name));
        $this->assertTrue(isset($entities->first()->name_en));
    }


}