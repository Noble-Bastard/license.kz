<?php

namespace App\Http\Controllers\Admin\Dictionary;

use App\Data\Core\Dal\CounterTypeDal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CounterTypeController extends Controller
{
    public function entityList()
    {
        $entityList = CounterTypeDal::getList(false);

        return response()->json($entityList);
    }
}
