<?php

namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;

class ServiceRequiredDocument extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'service_required_document',
            false
        );
    }

    public function document()
    {
        return $this->hasOne('App\Data\Document\Model\Document','id','document_template_id');
    }
}
