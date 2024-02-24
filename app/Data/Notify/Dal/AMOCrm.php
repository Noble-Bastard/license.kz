<?php

namespace App\Data\Notify\Dal;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AMOCrm
{
    public function callMe($channel, $fio, $phone, $email, $leadComment = null, $dealName = null, $tags = null, $roistatVisitId = null)
    {
        try {
            $amoLead = array(
                "url" => config('app.url'),
                "name" => $fio,
                "phone" => $phone,
                "email" => $email,
            );

            if ($leadComment) {
                $amoLead['lead_comment'] = $leadComment;
            }

            if ($tags) {
                $amoLead['lead_tags'] = [$tags];
            }

            if($roistatVisitId){
              $amoLead['roistat_visit'] = $roistatVisitId;
            }

            if (Session::has('utm')) {
                $utm_source = json_decode(Session::get('utm'));
                $amoLead['utm'] = array(
                    "utm_source" => $utm_source->utm_source ?? "",
                    "utm_medium" => $utm_source->utm_medium ?? "",
                    "utm_campaign" => $utm_source->utm_campaign ?? "",
                    "utm_term" => $utm_source->utm_term ?? "",
                    "utm_content" => $utm_source->utm_content ?? ""
                );
            }

            Log::info('AMOCrm lead' . json_encode($amoLead));

            $amoClient = new Client([
                'base_uri' => config('app.amocrm.callback') . $channel
            ]);
          Log::info('AMOCrm start');
            $response = $amoClient->request('POST', '', [
                'form_params' => $amoLead
            ]);
          Log::info('AMOCrm finish');
            (new Roistat())->createLead($fio, $phone, $email, $leadComment, $dealName);
        } catch (\Exception $e){
            Log::info($e);
        }
    }
}
