<?php

namespace App\Http\Controllers;


use App\Data\Service\Dal\ServiceDal;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use Illuminate\Support\Facades\Input;
use stdClass;

class ClientController extends Controller
{

    public function getAccounting()
    {
        $serviceStatuses = ServiceDal::getServiceStatusList();
        $serviceJournalList = ServiceJournalDal::getClientServiceJournalList($serviceStatuses[0]->id);
        return view('Client.accounting')
            ->with('serviceJournalList', $serviceJournalList)
            ->with('serviceStatuses', $serviceStatuses);
    }

    public function getServiceJounalList(){
        $serviceStatusId = Input::get('serviceStatusId');
        $entityData = new stdClass();
        $entityData->serviceJournalList = ServiceJournalDal::getClientServiceJournalList($serviceStatusId);
        return response()->json($entityData);
    }


}
