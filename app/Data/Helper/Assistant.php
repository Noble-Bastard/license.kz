<?php

namespace App\Data\Helper;

use App\Data\Core\Dal\SettingDal;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use App\Data\Service\Dal\CountryDal;
class Assistant
{
    public static function returnError($code, $message){
        return Response::json(array(
            'code'      =>  $code,
            'message'   =>   $message
        ), 404);
    }


    public static function formatNumber($contactNumber){
        return preg_replace( '/[^0-9]/', '', $contactNumber);
    }

    public static function getCurrentDate(){
        $datetime = new \DateTime();
        return $datetime;
    }
    public static function getCurrentDateYmd(){
        $datetime = Assistant::getCurrentDate()->format('Y-m-d');
        return $datetime;
    }

    public static function convertStringToDate($value, $inputFormat)
    {
        return \DateTime::createFromFormat($inputFormat, $value);
    }

    public static function firstDateOfCurrentYear()
    {
        return new \DateTime('first day of January this year');
    }

    public static function lastDateOfCurrentYear()
    {
        return new \DateTime('last day of December this year');
    }

    public static function IsNullOrEmptyString($inputStr){
        return (!isset($inputStr) || trim($inputStr)==='');
    }

    public static function formatDateTime($datetime){
        return \DateTime::createFromFormat('Y-m-d H:i:s', $datetime)->format('d.m.Y H:i');
    }
    public static function formatDate($datetime){
        if(is_null($datetime)){
            return "";
        }

        if(\DateTime::createFromFormat('Y-m-d H:i:s', $datetime)) {
            return \DateTime::createFromFormat('Y-m-d H:i:s', $datetime)->format('d.m.Y');
        } else {
            return \DateTime::createFromFormat('Y-m-d', $datetime)->format('d.m.Y');
        }
    }

    public static function convertDateFormat($datetime, $inputFormat, $outputFormat)
    {
        if(is_null($datetime)){
            return "";
        }

        return \DateTime::createFromFormat($inputFormat, $datetime)->format($outputFormat);
    }

    public static function convertDateFormatWithLocalize($datetime, $inputFormat, $outputFormat)
    {
        if(is_null($datetime)){
            return "";
        }
        setlocale(LC_TIME, App::getLocale());
        setlocale(LC_TIME, App::getLocale());
        //Carbon::setLocale("ru");
        return Carbon::parse($datetime)->formatLocalized($outputFormat);
    }

    public static function setCountryCode($countryCode = null)
    {
        if(is_null($countryCode)){
            if(!session()->has('user_location_code')) {
                $countryCode = Assistant::getCountryCodeFromClientIp();
                session(['user_location_code' => $countryCode]);
            }
        } else {
            session(['user_location_code' => $countryCode]);
        }

        //todo set default locale based on country
    }

    public static function setLocale($locale = null)
    {
        if(is_null($locale)){
            if(session()->has('locale')) {
                App::setLocale(session('locale'));
            }
        } else {
            session(['locale' => $locale]);
            App::setLocale($locale);
        }
    }

    public static function getCountryLocation()
    {
        return 'kz';
//        return session('user_location_code', 'kz');
    }


    public static function getCountryLocationId()
    {
        return CountryDal::getByCode(self::getCountryLocation());
    }


    public static function getCountryCodeFromClientIp()
    {
        $ip = Request::ip();
        return Assistant::getCountryCodeFromIp($ip);
    }
    /**
     * @param $ip
     * @return string|null
     */
    public static function getCountryCodeFromIp($ip)
    {
        if($ip == '127.0.0.1'){
            return 'kz';
        }

        $result = DB::select('SELECT
	            c.code
	        FROM
	            ip2nationCountries c,
	            ip2nation i
	        WHERE
	            i.ip < INET_ATON(?)
	            AND
	            c.code = i.country
	        ORDER BY
	            i.ip DESC
	        LIMIT 0,1', [$ip]);
        if ($row = array_pop($result))
        {
            return $row->code;
        }
        return 'kz';
    }

    /**
     * @param $value 325
     * @param $unit1 'рубль',
     * @param $unit2 'рубля'
     * @param $unit3 'рублей'
     * @return mixed
     */
    public static function num2word($value, $unit1, $unit2, $unit3 ){
        $value = abs( (int)$value );
        if( ($value % 100 >= 11) && ($value % 100 <= 19) ){
            return $unit3;
        }else{
            switch( $value % 10 ){
                case 1:
                    return $unit1;
                case 2:case 3:case 4:
                return $unit2;
                default:
                    return $unit3;
            }
        }
    }

    public static function getDefaultPaginateCnt()
    {
        return 15;
    }




    public static function getCurrentLanguageId()
    {
        switch (App::getLocale()) {
            case LocaleList::English:
                return LanguageList::English;
            case LocaleList::Russian:
                return LanguageList::Russian;
            default:
                return SettingDal::get()->default_language_id;
        }
    }

    public static function subStrCutByWord($str, $len){
        if(strlen($str) < $len){
            return $str;
        }

        $result = substr($str, 0, $len);

        $lastSpacePos = strripos($result, ' ');
        if($lastSpacePos === false){
            return $result;
        }

        $result = substr($result, 0, $lastSpacePos);

        return $result;
    }
}
