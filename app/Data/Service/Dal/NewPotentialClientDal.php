<?php

namespace App\Data\Service\Dal;

use App\Data\Core\Dal\BaseDal;
use App\Data\Helper\PaymentTypeList;
use App\Data\Helper\ProfileStateTypeList;
use App\Data\Service\Model\CommercialOffer;
use App\Data\Service\Model\NewPotentialClient;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Http\Controllers\Auth\RegisterController;
use Dompdf\Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewPotentialClientDal extends BaseDal
{
    public function __construct()
    {
        parent::__construct(NewPotentialClient::class);
    }

    public function createCabinet($potentialClientId)
    {
        $entity = $this->get($potentialClientId);

        DB::beginTransaction();
        try {
            $pass = Str::random('8');
            //create account
            $registerController = new RegisterController();
            $user = $registerController->createUserAndProfile([
                "full_name" => $entity->name,
                "phone" => $entity->phone,
                "email" => $entity->email,
                "password" => $pass,
                "profile_state_type_id" => ProfileStateTypeList::Idividual,
                "is_resident" => true,
                "send_pass" => true
            ]);
            //create service journal
            $profileLegal = null;
            $paymentTypeId = PaymentTypeList::BasicPaymentType;
            $selectedCityId = null;
            $serviceIdList = array();
            foreach ($entity->serviceList as $service){
                array_push($serviceIdList, $service->id);
            }
            
            if(sizeof($serviceIdList) > 0) {
              ServiceJournalDal::newServiceRequest($serviceIdList, $profileLegal, $paymentTypeId, $selectedCityId);
            }

            $entity->is_account_generate = true;
            $entity->is_contacted = true;
            $entity->save();

            DB::commit();
        } catch (\Exception $ex){
            DB::rollBack();
            throw $ex;
        }
    }

    public function setContacted($potentialClientId)
    {
        $entity = $this->get($potentialClientId);
        $entity->is_contacted = true;
        $entity->save();
    }
}
