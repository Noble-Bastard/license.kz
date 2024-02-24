<?php


namespace App\Data\Core\Dal;

use App\Data\Core\Model\ProfileLegal;

class ProfileLegalDal extends BaseDal
{
    public function __construct()
    {
        parent::__construct(ProfileLegal::class);
    }

}