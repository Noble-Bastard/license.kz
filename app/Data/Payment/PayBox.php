<?php


namespace App\Data\Payment;


use App\Data\Dbo\Model\Order;
use App\Data\Notify\Dal\AMOCrm;
use App\Data\Service\Model\Consultation;
use App\Data\Service\Model\ConsultationPayment;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Nathanmac\Utilities\Parser\Facades\Parser;
use Spatie\ArrayToXml\ArrayToXml;

class PayBox
{
    private $base_url = 'https://api.paybox.money/';

    private $consultationNo;
    private $orderAmount;
    private $clientPhone;
    private $clientEmail;
    private $merchantId;
    private $secretKey;

    /**
     * PayBox constructor.
     * @param $consultationNo
     * @param $orderAmount
     * @param $merchantId
     * @param $secretKey
     */
    public function __construct($merchantId, $secretKey)
    {
        $this->merchantId = $merchantId;
        $this->secretKey = $secretKey;
    }

    public function initPayment($consultationNo, $orderAmount, $itemList, $clientPhone, $clientEmail){
        $this->consultationNo = $consultationNo;
        $this->orderAmount = $orderAmount;
        $this->clientPhone = $clientPhone;
        $this->clientEmail = $clientEmail;

//        $pg_receipt_positions = array();
//        foreach ($itemList as $item){
//            array_push($pg_receipt_positions, [
//                count => $item->qty,
//                name => $item->name,
//                price => $item->price,
////                tax_type =>
//            ]);
//        }

        $request = [
            'pg_merchant_id' => $this->merchantId,
            'pg_order_id' => $this->consultationNo,
            'pg_amount' => $this->orderAmount,
            'pg_currency' => 'KZT',
            'pg_salt' => $this->getSalt(),
            'pg_user_phone' => preg_replace('/[^0-9]/', '', $this->clientPhone),
//            'pg_user_contact_email' => $this->clientEmail,
//            'pg_receipt_positions' => $pg_receipt_positions,

            'pg_description' => 'Оплата заказа ' . $this->consultationNo . ' на сайте ' . config('app.name'),
            'pg_result_url' => route('Payment.paybox.payment_result'),
            'pg_success_url' => route('service.consultation.paymentComplete')
        ];


        $request = $this->generateSig($request, 'init_payment.php');

        $xml = ArrayToXml::convert($request, 'request');

        $client = new Client();

        Log::info($xml);

        $response = $client->request('POST', $this->base_url . 'init_payment.php', [
            'form_params' => [
                'pg_xml' => $xml
            ]
        ]);

        if($response->getStatusCode() == 200) {
            $data = $response->getBody()->getContents();
            return redirect($this->responseProcessing($data));
        }  else {
            return route('/');
        }
    }

    public function paymentResult($parseResult)
    {
//        $parseResult = Parser::xml($xmlString);
        $orderPayment = ConsultationPayment::where('pg_payment_id', $parseResult['pg_payment_id'])->first();

        if(!$orderPayment){
            return abort(404);
        }

        $orderPayment->pg_currency = $parseResult['pg_currency'];
        $orderPayment->pg_amount = $parseResult['pg_amount'];
        $orderPayment->pg_payment_system = $parseResult['pg_payment_system'];
        $orderPayment->pg_result = $parseResult['pg_result'];
        $orderPayment->pg_payment_date = $parseResult['pg_payment_date'];
        $orderPayment->pg_can_reject = $parseResult['pg_can_reject'];
        $orderPayment->pg_card_brand = array_key_exists('pg_card_brand', $parseResult) ? $parseResult['pg_card_brand'] : null;
        $orderPayment->pg_card_pan = array_key_exists('pg_card_pan', $parseResult) ? $parseResult['pg_card_pan'] : null;
        $orderPayment->pg_failure_code = array_key_exists('pg_failure_code', $parseResult) ? $parseResult['pg_failure_code'] : null;
        $orderPayment->pg_failure_description = array_key_exists('pg_failure_description', $parseResult) ? $parseResult['pg_failure_description'] : null;
        $orderPayment->save();

        if($orderPayment->pg_result == '1'){
            $order = $orderPayment->consultation;
            $name = $order->name;
            $phone = $order->phone;
            $email = $parseResult['pg_user_contact_email'];
            $comment = 'Платная консультация. Сфера деятельности - ' . $order->activity . '. ' . 'Вопрос - ' . $order->question;

            $log = new \stdClass();
            $log->order = $order;
            $log->name = $name;
            $log->phone = $phone;
            $log->email = $email;
            $log->comment = $comment;
//            Log::info(json_encode($log));
            $roistatVisitId = array_key_exists('roistat_visit', $_COOKIE) ? $_COOKIE['roistat_visit'] : "неизвестно";
            (new AMOCrm())->callMe('license-kz-callback', $name, $phone, $email, $comment, 'Платная консультация', null, $roistatVisitId);
        }

        $response = [
            'pg_status' => 'ok',
            'pg_salt' => $this->getSalt(),
        ];

        $response = $this->generateSig($response, last(Request::segments()));

        $xml = ArrayToXml::convert($response, 'response');

        return response($xml, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }

    private function responseProcessing($responseData){
            Log::info($responseData);
            $parseResult = Parser::xml($responseData);

            $consultation = Consultation::where('consultation_no', $this->consultationNo)->first();
            $orderPayment = new ConsultationPayment();
            $orderPayment->consultation_id = $consultation->id;
            $orderPayment->pg_status = $parseResult['pg_status'];

            if($parseResult['pg_status'] == "ok"){
                $orderPayment->pg_payment_id = $parseResult['pg_payment_id'];
            } else {
                $orderPayment->pg_error_code = $parseResult['pg_error_code'];
                $orderPayment->pg_error_description = $parseResult['pg_error_description'];
            }

            $orderPayment->save();

            return $parseResult['pg_redirect_url'];
    }


    public function generateSig($request, $method){
        ksort($request);
        array_unshift($request, $method);
        array_push($request, $this->secretKey);


        $request['pg_sig'] = md5(implode(';', $request));

        unset($request[0], $request[1]);

        return $request;
    }

    private function getSalt(){
        return Str::random(16);
    }

}
