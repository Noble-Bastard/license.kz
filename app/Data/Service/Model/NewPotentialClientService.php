<?php

namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;

class NewPotentialClientService extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'new_potential_client_service',
            false
        );
    }
}
