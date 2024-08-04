<?php

namespace App\Listeners;

use App\Events\SendSmsEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSms
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendSmsEvent  $event
     * @return void
     */
    public function handle(SendSmsEvent $event)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'http://login.businesslead.co.in/api/mt/SendSMS?user=icaps&password=icaps@231&senderid=icapsr&channel=Trans&DCS=0&flashsms=0&number='.$event->mobile.'&text='.urlencode($event->message).'&route=6');
        curl_exec($ch);        
    }
}
