<?php

namespace App\Data\Service\Import\Data;

class Step
{
    public $stepNo;
    public $stepIdx;
    public $name;
    public $nameEn;

    public $time;
    public $tax;
    public $cost;

    public $documents = array();
    public $results = array();
}