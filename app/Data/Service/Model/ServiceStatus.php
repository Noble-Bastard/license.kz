<?php

namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ServiceStatus extends BaseTableModel
{
    use SoftDeletes;

    public function __construct()
    {
        parent::__construct(
            'service_status',
            false
        );
    }

}