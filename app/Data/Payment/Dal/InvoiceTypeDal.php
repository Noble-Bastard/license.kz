<?php


namespace App\Data\Payment\Dal;


use App\Data\Core\Dal\BaseDal;
use App\Data\Payment\Model\InvoiceType;

class InvoiceTypeDal extends BaseDal
{
    public function __construct()
    {
        parent::__construct(InvoiceType::class);

    }


}