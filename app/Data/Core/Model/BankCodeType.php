<?php


namespace App\Data\Core\Model;


class BankCodeType extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'bank_code_type',
            false
        );
    }

}
