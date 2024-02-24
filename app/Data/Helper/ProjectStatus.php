<?php
/**
 * Created by PhpStorm.
 * User: r.biewald
 * Date: 15.05.2018
 * Time: 0:36
 */

namespace App\Data\Helper;


class ProjectStatus
{
    const Waiting = 1;
    const InWork = 2;
    const Closed = 3;
    const Done = 4;
    const Review = 5;
}