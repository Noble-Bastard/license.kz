<?php

namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;

class NewPotentialClient extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'new_potential_client',
            true
        );
    }

    public function serviceList()
    {
        return $this->hasMany(Service::class, 'id', 'service_id');
    }
}
