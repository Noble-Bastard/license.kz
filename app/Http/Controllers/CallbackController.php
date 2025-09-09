<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function store(Request $request)
    {
        // Логика обработки обратного звонка
        return response()->json(['success' => true, 'message' => 'Заявка принята']);
    }
}
