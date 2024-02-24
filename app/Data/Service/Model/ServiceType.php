<?php


namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;

class ServiceType extends BaseTableModel
{
    public function __construct()
    {
        parent::__construct(
            'service_type',
            false
        );
    }
}