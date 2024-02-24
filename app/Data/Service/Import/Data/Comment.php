<?php

namespace App\Data\Service\Import\Data;

class Comment
{
    public $name;
    public $nameEn;


    public function __construct($name, $nameEn)
    {
        $this->name = $name;
        $this->nameEn = $nameEn;
    }


}