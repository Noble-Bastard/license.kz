<?php

namespace App\Data\Payment\Model;

use App\Data\Core\Model\BaseTableModel;

class AgreementType extends BaseTableModel
{
    public function __construct()
    {
        parent::__construct(
            'agreement_type',
            false
        );
    }
}
