<?php

namespace App\Console\Commands;

use App\Events\SendSmsEvent;
use Event;
use App\Model\Catalog\Order;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
class OrderSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send order detail to admin by sms';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //whereMonth('DOB','=',Carbon::today()->month)
        //$date = \Carbon\Carbon::now()->format('d:m');
        
        if(\Carbon\Carbon::now()->format('H:i') == '22:01'){
           
            $order = Order::where('status',1)->count();
            if($order > 0){
                Event::fire(new SendSmsEvent('9416865711,9996786073,7082690096','Total pending order is '.$order));
                Log::info('Today total order is'.$order);
            }
        }
        if(\Carbon\Carbon::now()->format('H:i') == '8:00'){
            $users  = User::where('member_status',1)->whereMonth('dob','=',\Carbon\Carbon::today()->month)->whereDay('dob','=',\Carbon\Carbon::today()->day)->get();
            foreach($users as $user){
                Event::fire(new SendSmsEvent($user->mobile,'Dear member, Icaps wish you very happy birthday.'));
                Log::info('Dear member, Icaps wish you very happy birthday.'.$user->first_name);
            }
        }

    }
}
