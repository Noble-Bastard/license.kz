<?php
namespace App\Http\Controllers;

use App\Data\Core\Dal\CounterDal;
use App\Data\Dbo\Dal\OrderDal;
use App\Data\Helper\CounterTypeList;
use App\Data\Payment\PayBox;
use App\Data\Service\Model\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ConsultationService extends Controller
{
    public function info()
    {
        return view('services.consultation.info');
    }

    public function form()
    {
        return view('services.consultation.form');
    }

    public function newQuestion(Request $request)
    {
        $this->validate($request, [
            'question' => 'required|string|max:4096',
            'activity' => 'required|string|max:256',
            'name' => 'required|string|max:128',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        //save to DB
        $consultation = new Consultation();
        $consultation->consultation_no = CounterDal::getCounterValue(CounterTypeList::CONSULTATION_SERVICE_COUNTER);
        $consultation->name = $request->get('name');
        $consultation->phone = $request->get('phone');
        $consultation->activity = $request->get('activity');
        $consultation->question = $request->get('question');
        $consultation->save();
        //send to paybox
        $payBox = new PayBox(config('app.api.paybox.merchantid'), config('app.api.paybox.secretkey'));
        return $payBox->initPayment($consultation->consultation_no, round(\App\Data\Core\Dal\SettingDal::getConsultationServiceCost()), [], $consultation->phone, null);
    }

    //confirm paybox
    public function paymentComplete()
    {
        $order = Consultation::where('consultation_no', Input::get('pg_order_id'))->first();
        if($order) {
            \session()->flash('new_order', $order->consultation_no);
            return redirect(route('service.consultation.info'));
        } else {
            return abort(404);
        }
    }
}
