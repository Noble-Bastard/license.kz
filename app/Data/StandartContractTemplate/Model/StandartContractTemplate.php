<?php

namespace App\Data\StandartContractTemplate\Model;

use App\Data\Core\Model\BaseTableModel;


/**
 *  App\Data\StandartContractTemplate\Model\StandartContractTemplate
 *
 * @property int $id
 * @property string $name
 * @property string $friendly_name
 * @property string $path
 * @property int $country_id
 * @property int $standart_contract_template_type_id
 *
 * @mixin \Eloquent
 */
class StandartContractTemplate extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'standart_contract_template',
            false
        );
    }

    public function standartContractTemplateType()
    {
        return $this->hasOne('App\Data\StandartContractTemplate\Model\StandartContractTemplateType','id','standart_contract_template_type_id');
    }

    public function country()
    {
        return $this->hasOne('App\Data\Service\Model\Country','id','country_id');
    }
}
