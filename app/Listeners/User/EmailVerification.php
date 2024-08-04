<?php

namespace App\Listeners\User;

use App\Events\User\EmailVerification as EmailVerificationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\User\EmailVerificationMail;
use App\User;
use App\UserEmailVerify;
use Mail;
class EmailVerification
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
     * @param  EmailVerification  $event
     * @return void
     */
    public function handle(EmailVerificationEvent $event)
    {
        if ($event->user->count()) {
            if ($event->user->email) {
                $data = UserEmailVerify::firstOrNew(['user_id'=>$event->user->id]);;
                $data->user_id = $event->user->id;
                $data->email = $event->user->email;
                $data->token = str_random(150);
                $data->status = 0;
                $data->save();
                Mail::to($event->user->email)->queue(new EmailVerificationMail($data));
            }
            
        }
    }
}
