<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Mail\User\AccountActivation;
use Auth;
class DashboardController extends Controller
{
    //
    public function email()
    {
    	# code...
    	Mail::to('amarkumar004@gmail.com')->send(new AccountActivation());
    	return redirect()->route('user.dashboard');
    }
}
