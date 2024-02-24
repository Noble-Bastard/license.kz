<?php

namespace App\Data\Core\Dal;

use App\Data\Core\Model\Setting;


class SettingDal
{

    /**
     * Get all settings
     *
     * @return Setting
     */
    public static function get()
    {
        $entity = Setting::first();
        return $entity;
    }

    public static function setClientRequestResponseTime ($clientRequestResponseTime)
    {
        $entity = self::get();
        $entity->client_request_response_time = $clientRequestResponseTime;
        $entity->save();
        return $entity;
    }

    public static function setMrp ($mrp)
    {
        $entity = self::get();
        $entity->mrp = $mrp;
        $entity->save();
        return $entity;
    }

    public static function getMrp ()
    {
        $entity = self::get();
        return $entity->mrp;
    }

    public static function setClientCheckCost ($clientCheckCost)
    {
        $entity = self::get();
        $entity->client_check_cost = $clientCheckCost;
        $entity->save();
        return $entity;
    }

    public static function getClientCheckCost ()
    {
        $entity = self::get();
        return $entity->client_check_cost;
    }

    public static function setConsultationServiceCost ($consultationServiceCost)
    {
        $entity = self::get();
        $entity->consultation_service_cost = $consultationServiceCost;
        $entity->save();
        return $entity;
    }

    public static function getConsultationServiceCost ()
    {
        $entity = self::get();
        return $entity->consultation_service_cost;
    }

    public static function setPrepaymentCost ($prepaymentCost)
    {
        $entity = self::get();
        $entity->prepayment_cost = $prepaymentCost;
        $entity->save();
        return $entity;
    }

    public static function getPrepaymentCost ()
    {
        $entity = self::get();
        return $entity->prepayment_cost;
    }

    public static function getClientRequestResponseTime ()
    {
        $entity = self::get();
        return $entity->client_request_response_time;
    }

    public static function getAgreementCounterType()
    {
        $entity = self::get();
        return $entity->areement_counter_type_id;
    }

    public static function getPaymentInvoiceCounterType()
    {
        $entity = self::get();
        return $entity->payment_counter_type_id;
    }

    public static function getInvoiceCounterType()
    {
        $entity = self::get();
        return $entity->invoice_counter_type_id;
    }

}
