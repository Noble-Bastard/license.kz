<?php

namespace App\Http\Controllers\Payment;

use App\Data\Cart\Dal\CartDal;
use App\Data\Core\Dal\CategoryDal;
use App\Data\Payment\PayBox;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Mail\NewOrder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Nathanmac\Utilities\Parser\Facades\Parser;

class PayboxController extends Controller
{
    public function payment_result()
    {
        $responseData = Request::all();
        Log::info($responseData);
        $payBox = new PayBox(config('app.paybox.merchantid'), config('app.paybox.secretkey'));
        return $payBox->paymentResult($responseData);
    }
}
