<?php

namespace App\Http\Controllers\Head;

use App\Data\Core\Dal\ProfileDal;
use App\Data\Helper\Assistant;
use App\Data\Service\Dal\CountryDal;
use App\Data\Service\Dal\ServiceDal;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use stdClass;

class HeadController extends Controller
{
    //
    /**
     * @return mixed
     */
    public function analytics()
    {
        $start_date=Assistant::getCurrentDateYmd();
        $end_date=Assistant::getCurrentDateYmd();
        $countryList = CountryDal::getList(false);
        $country_id=Assistant::getCountryLocation();
        $user_count=ProfileDal::getCountClient($country_id,$start_date,$end_date);
        return view('Head.Analytics.index')
            ->with('countryList', $countryList->pluck('name', 'id'))
            ->with('country_id',$country_id)
            ->with('start_date',$start_date)
            ->with('end_date',$end_date)
            ->with('user_count',$user_count);
    }


    public function setfilter(Request $request)
    {
        Validator::make($request->all(), [
            'country_id' => 'required'
        ])->validate();

        $country_id= Input::get('country_id');
        $start_date= Input::get('start_date');
        $end_date= Input::get('end_date');
        $user_count=ProfileDal::getCountClient($country_id,$start_date,$end_date);
        $countryList = CountryDal::getList(false);
        return view('Head.Analytics.index')
            ->with('countryList', $countryList->pluck('name', 'id'))
            ->with('country_id',$country_id)
            ->with('start_date',$start_date)
            ->with('end_date',$end_date)
            ->with('user_count',$user_count);
    }


    public function getServiceList()
    {
        $serviceStatuses = ServiceDal::getServiceStatusList();
        $serviceJournalList = ServiceJournalDal::getHeadServiceJournalList($serviceStatuses[0]->id);

        return view('Head.services')
            ->with('serviceJournalList', $serviceJournalList)
            ->with('serviceStatuses', $serviceStatuses);
    }

    public function entityList(){
        $serviceStatusId = Input::get('serviceStatusId');
        $entityData = new stdClass();
        $entityData->serviceJournalList = ServiceJournalDal::getHeadServiceJournalList($serviceStatusId);
        return response()->json($entityData);
    }

    public function setServiceJournalStatus(Request $request)
    {
        Validator::make($request->all(), [
            'serviceJournalId' => 'required',
            'serviceJournalStatusId' => 'required',
        ])->validate();


        $serviceJournalId = Input::get('serviceJournalId');
        $serviceJournalStatusId = Input::get('serviceJournalStatusId');
        ServiceJournalDal::setServiceJournalStatus($serviceJournalId, $serviceJournalStatusId);

        return redirect(URL::previous());
    }

}
