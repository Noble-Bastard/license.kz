<?php

namespace App\Data\Notify\Dal;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class Roistat
{
    public function createLead($fio, $phone, $email, $leadComment, $dealName)
    {
        $roistatData = array(
            'roistat' => isset($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : 'nocookie',
            'key' => config('app.api.roistat.key'), // Ключ для интеграции с CRM, указывается в настройках интеграции с CRM.
            'title' => $dealName, // Название сделки
            'comment' => $leadComment, // Комментарий к сделке
            'name' => $fio, // Имя клиента
            'email' => $email, // Email клиента
            'phone' => $phone, // Номер телефона клиента
            'order_creation_method' => '', // Способ создания сделки (необязательный параметр). Укажите то значение, которое затем должно отображаться в аналитике в группировке "Способ создания заявки"
            'is_need_callback' => '0', // После создания в Roistat заявки, Roistat инициирует обратный звонок на номер клиента, если значение параметра равно 1 и в Ловце лидов включен индикатор обратного звонка.
            'sync' => '0', //
            'is_need_check_order_in_processing' => '1', // Включение проверки заявок на дубли
            'is_need_check_order_in_processing_append' => '1', // Если создана дублирующая заявка, в нее будет добавлен комментарий об этом
            'is_skip_sending' => '1', // Не отправлять заявку в CRM.
        );

        file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));
    }
}