<?php

namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;

class Currency extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'currency',
            false
        );
    }


}
