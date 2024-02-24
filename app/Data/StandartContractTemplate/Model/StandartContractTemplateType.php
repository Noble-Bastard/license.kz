<?php

namespace App\Data\StandartContractTemplate\Model;

use App\Data\Core\Model\BaseTableModel;

class StandartContractTemplateType extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'standart_contract_template_type',
            false
        );
    }

}
