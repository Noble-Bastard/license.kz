<?php

namespace App\Http\Controllers\Report;

use App\Data\Core\Dal\ReportDal;
use App\Data\Helper\Assistant;
use App\Data\Service\Dal\CountryDal;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ReportController extends Controller
{
    private $validateRule = [
        'country_id' => 'required|numeric',
        'start_date' => 'required|string|max:20',
        'end_date' => 'required|string|max:20'
    ];
    //
    public function index()
    {
        $startDate= Assistant::getCurrentDateYmd();
        $endDate=  Assistant::getCurrentDateYmd();
        $countryList = CountryDal::getList(false);
        $countryId = CountryDal::getByCode('kz')->id;
        return view('Report.index')
            ->with('countryList', $countryList)
            ->with('countryId',$countryId)
            ->with('startDate',$startDate)
            ->with('endDate',$endDate);
    }

    public function getClientCountReportData(){

        $countryId = Input::get('countryId');
        $startDate= $this->formatDate(Input::get('startDate'));
        $endDate= $this->formatDate(Input::get('endDate'));

        $clientCount=ReportDal::getCountClient($countryId,$startDate,$endDate);
        return response()->json($clientCount);
    }

    public function getServiceCompeteReportData()
    {
        $countryId = Input::get('countryId');
        $startDate= $this->formatDate(Input::get('startDate'));
        $endDate= $this->formatDate(Input::get('endDate'));
        $ServiceCompeteCount = ReportDal::getServiceComplete($countryId,$startDate,$endDate);
        return response()->json($ServiceCompeteCount);
    }


    public function getServiceInProgressReportData()
    {
        $countryId = Input::get('countryId');
        $startDate= $this->formatDate(Input::get('startDate'));
        $endDate= $this->formatDate(Input::get('endDate'));
        $ServiceInProgressCount = ReportDal::getServiceInProgress($countryId,$startDate,$endDate);
        return response()->json($ServiceInProgressCount);
    }

    public function getServiceNoPaymentAmountReportData()
    {
        $countryId = Input::get('countryId');
        $startDate= $this->formatDate(Input::get('startDate'));
        $endDate= $this->formatDate(Input::get('endDate'));
        $ServiceNoPaymentAmountCount = ReportDal::getServiceNoPaymentAmount($countryId,$startDate,$endDate);
        return response()->json($ServiceNoPaymentAmountCount);
    }
    public function getAttendanceReportData()
    {
        $countryId = Input::get('countryId');
        $startDate= $this->formatDate(Input::get('startDate'));
        $endDate= $this->formatDate(Input::get('endDate'));
        $Attendance = ReportDal::getAttendanceReportData($countryId,$startDate,$endDate);
        return response()->json($Attendance);
    }
    public function getJobEvaluationReportData()
    {
        $countryId = Input::get('countryId');
        $startDate= $this->formatDate(Input::get('startDate'));
        $endDate= $this->formatDate(Input::get('endDate'));
        $JobEvaluation = ReportDal::getJobEvaluationReportData($countryId,$startDate,$endDate);
        return response()->json($JobEvaluation);
    }

    private function formatDate($val){
        if($val == "null"){
            return Assistant::getCurrentDateYmd();
        }
        return \Carbon\Carbon::parse($val)->format('Y-m-d');
    }
}
