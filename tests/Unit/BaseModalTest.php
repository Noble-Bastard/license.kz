<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-11
 * Time: 12:01 PM
 */

namespace Tests\Unit;


use App\Data\StandartContractTemplate\Model\StandartContractTemplateType;

use Tests\TestCase;

class BaseModalTest extends TestCase
{

    public function testGetTableNameByStandartContractTemplateTypeShouldBeEqualTableName()
    {
        $standartContractTemplateType = new StandartContractTemplateType();
        $this->assertEquals($standartContractTemplateType->getTableName(), 'standart_contract_template_type');
    }

    public function testGetFieldsByStandartContractTemplateTypeShouldContainIdAndName()
    {
        $standartContractTemplateType = new StandartContractTemplateType();
        $fields = $standartContractTemplateType->getFields();
        $this->assertContains('id', $fields);
        $this->assertContains('name', $fields);
    }

    public function testGetNotTranslatableFieldByStandartContractTemplateTypeShouldBeEqualId()
    {
        $standartContractTemplateType = new StandartContractTemplateType();
        $notTranslatableFields = $standartContractTemplateType->getNotTranslatableFields();
        self::assertContains('standart_contract_template_type.id', $notTranslatableFields);
        self::assertCount(1, $notTranslatableFields);
    }


}