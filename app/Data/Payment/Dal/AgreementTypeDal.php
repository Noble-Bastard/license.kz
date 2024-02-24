<?php


namespace App\Data\Payment\Dal;


use App\Data\Core\Dal\BaseDal;
use App\Data\Payment\Model\AgreementType;
use App\Data\Payment\Model\InvoiceType;

class AgreementTypeDal extends BaseDal
{
    public function __construct()
    {
        parent::__construct(AgreementType::class);
    }
}