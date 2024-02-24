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
use App\Data\Service\Dal\CommercialOfferDal;
use App\Data\Service\Dal\NewPotentialClientDal;
use App\Data\Service\Dal\PotentialClientDal;
use App\Data\Service\Dal\ServiceDal;
use App\Data\Service\Model\CommercialOffer;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class PotentialClientController
{
    public function index()
    {
        $potentialClientList = (new NewPotentialClientDal())->getList(true, ['serviceList']);

        return view('SaleManager.potential_client.index')
            ->with('potentialClientList', $potentialClientList);
    }

    public function createCabinet($potentialClientId)
    {
        (new NewPotentialClientDal())->createCabinet($potentialClientId);
        return redirect(URL::previous());
    }

    public function setContacted($potentialClientId)
    {
        (new NewPotentialClientDal())->setContacted($potentialClientId);
        return redirect(URL::previous());
    }
}