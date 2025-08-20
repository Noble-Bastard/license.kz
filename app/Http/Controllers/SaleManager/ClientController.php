<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-01-17
 * Time: 7:58 PM
 */

namespace App\Http\Controllers\SaleManager;


use App\Data\Core\Dal\ProfileDal;
use App\Data\Helper\RoleList;
use Illuminate\Support\Facades\Input;

class ClientController
{
    public function index()
    {
        $agentList = ProfileDal::getListByRoles([RoleList::Agent], false)
            ->map(function ($user) {
                return collect($user->toArray())
                    ->only(['id', 'full_name'])
                    ->all();
            });

        $searchText = Input::get('searchText');
        $clientList = ProfileDal::getListWithAgentInfo(true, $searchText);

        return view('SaleManager.Client.index')
            ->with('agentList', $agentList)
            ->with('clientList', $clientList);
    }

    public function clientList()
    {
        $searchText = Input::get('searchText');

        $clientList = ProfileDal::getListWithAgentInfo(true, $searchText);

        return response()->json($clientList);
    }

    public function setAgent(){
        $profileId = Input::get('id');
        $agentId = Input::get('agent_id');

        ProfileDal::setAgent($profileId, $agentId);

        return response()->json(1);
    }
}