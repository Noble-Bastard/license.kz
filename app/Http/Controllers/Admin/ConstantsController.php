<?php

namespace App\Http\Controllers\Admin;

use App\Data\Core\Dal\SettingDal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ConstantsController extends Controller
{

    public function index()
    {
        $settingDal = SettingDal::get();
        return view('admin.constants.index')
            ->with('ClientRequestResponseTime', $settingDal->client_request_response_time)
            ->with('Mrp', $settingDal->mrp)
            ->with('ClientCheckCost', $settingDal->client_check_cost)
            ->with('ConsultationServiceCost', $settingDal->consultation_service_cost)
            ->with('PrepaymentCost', $settingDal->prepayment_cost);
    }

    public function setConstant(){
        $constantType = Input::get('ConstantType');
        $constValue = Input::get('ConstantValue');

        switch ($constantType) {
            case 'ClientRequestResponseTime':
                SettingDal::setClientRequestResponseTime ($constValue);
                break;
            case 'Mrp':
                SettingDal::setMrp($constValue);
                break;
            case 'ClientCheckCost':
                SettingDal::setClientCheckCost($constValue);
                break;
            case 'ConsultationServiceCost':
                SettingDal::setConsultationServiceCost($constValue);
                break;
            case 'PrepaymentCost':
                SettingDal::setPrepaymentCost($constValue);
                break;
        }
        return 1;
    }


}
