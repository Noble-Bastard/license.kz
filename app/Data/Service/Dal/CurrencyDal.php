<?php

namespace App\Data\Service\Dal;

use App\Data\Core\Dal\BaseDal;
use App\Data\Service\Model\Currency;

class CurrencyDal extends BaseDal
{
    public function __construct()
    {
        parent::__construct(Currency::class);
    }

    public function init($currencyCode) : Currency
    {
        $outCurrency = $this->getByCode($currencyCode);
        if(is_null($outCurrency)){
            $outCurrency = new Currency();
            $outCurrency->code = $currencyCode;
            $outCurrency->name = $currencyCode;
            $outCurrency =  $this->set($outCurrency);
        }
        return $outCurrency;
    }
}
