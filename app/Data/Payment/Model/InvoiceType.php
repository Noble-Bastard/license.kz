<?php

namespace App\Data\Payment\Model;

use App\Data\Core\Model\BaseTableModel;

class InvoiceType extends BaseTableModel
{
    public function __construct()
    {
        parent::__construct(
            'invoice_type',
            false
        );
    }
}
