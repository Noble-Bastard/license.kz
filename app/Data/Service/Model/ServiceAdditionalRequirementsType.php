<?php


namespace App\Data\Service\Model;


use App\Data\Core\Model\BaseTableModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceAdditionalRequirementsType extends BaseTableModel
{
    use SoftDeletes;

    public function __construct()
    {
        parent::__construct(
            'service_additional_requirements_type',
            false
        );
    }
}