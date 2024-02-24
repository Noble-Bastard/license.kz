<?php


namespace App\Services\Countries;


class CountriesRest
{
    const api_url = "https://restcountries.eu/rest/v2/";

    public static function getByCode($countyCode)
    {
        $additionalParams = "?fullText=true&fields=name;flag;alpha2Code";

        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->get(self::api_url . 'alpha/' . $countyCode . $additionalParams);
            $response = $request->getBody()->getContents();

            $data = json_decode($response);

            if (!isset($data->status)) {
                if(is_array($data)){
                    return $data[0];
                } else{
                    return $data;
                }

            } else {
                return null;
            }
        } catch (\Exception $e){
            return null;
        }
    }
}