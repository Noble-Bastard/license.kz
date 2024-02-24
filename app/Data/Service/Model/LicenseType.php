<?php


namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;

class LicenseType extends BaseTableModel
{
    public function __construct()
    {
        parent::__construct(
            'license_type',
            false
        );
    }
}