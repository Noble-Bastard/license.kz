<?php

namespace App\Data\Subsciption\Dal;

use App\Data\Subsciption\Model\EventSubscription;
use Illuminate\Support\Str;

class EventSubscriptionDal
{
    public function subscipt(string $name, string $email)
    {
        $eventSubscription = new EventSubscription();
        $eventSubscription->id = (string) Str::uuid();
        $eventSubscription->email = $email;
        $eventSubscription->name = $name;
        $eventSubscription->save();
    }

    public function unsubscipt(string $uuid)
    {
        $eventSubscription = EventSubscription::where('id', $uuid)->first();
        if($eventSubscription){
            $eventSubscription->delete();
        }
    }

    public function getSubscriptionList()
    {
        return EventSubscription::get();
    }
}