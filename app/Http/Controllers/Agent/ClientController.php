<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-01-18
 * Time: 3:39 PM
 */

namespace App\Http\Controllers\Agent;


use App\Data\Core\Dal\ProfileDal;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Data\ServiceJournal\Model\ServiceJournal;
use Illuminate\Support\Facades\Auth;

class ClientController
{
    public function index()
    {
        $profile = ProfileDal::getByUserId(Auth::id());
        $clientList = ProfileDal::getListByAgent($profile->id, true);

        return view('Agent.index')
            ->with('clientList', $clientList);
    }

    public function clientList()
    {
        $profile = ProfileDal::getByUserId(Auth::id());
        $clientList = ProfileDal::getListByAgent($profile->id, true);
        return response()->json($clientList);
    }

    public function getServiceJournalList($clientId)
    {
        $profile = ProfileDal::getByUserId(Auth::id());

        $serviceJournalList = ServiceJournalDal::getServiceJournalListByClientAndAgent($clientId, $profile->id, false);
        return response()->json($serviceJournalList);
    }
}