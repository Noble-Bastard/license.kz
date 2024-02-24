<?php

namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;

/**
 * App\Data\Service\Model\ServiceCategoryType
 *
 * @property int $id
 * @property string $name
 * @mixin \Eloquent
 */

class ServiceCategoryType extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'service_category_type',
            false
        );
    }
}
