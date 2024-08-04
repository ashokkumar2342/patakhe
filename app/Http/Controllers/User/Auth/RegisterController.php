<?php

namespace App\Http\Controllers\User\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Controller;
use App\Events\User\EmailVerification;
use App\Events\SendSmsEvent;
use App\UserMobileVerify;
use App\UserEmailVerify;
use Event;
use Auth;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/account/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('user.guest');
    }
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('user.auth.register');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'sometimes|nullable|email|max:255|unique:users',
            'mobile' =>'required|numeric|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
       
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
    *user resigstration with sending activation code and activation link
    *
    */

    public function generateOtp($user){
            $otp = rand(1000000,9999999);

            $data = new UserMobileVerify();
            $data->user_id = $user->id;
            $data->mobile = $user->mobile;
            $data->confirmation_code = $otp;
            $data->status = 0;
            if($data->save()){
                $message = $otp.' is your icaps verification code.';
                Event::fire(new SendSmsEvent($user->mobile, $message));
            }
    }
    public function register(Request $request){
        $this->validator($request->all())->validate();
        Event::fire(new Registered($user = $this->create($request->all())));
        $this->generateOtp($user);
        Event::fire(new EmailVerification($user));
        Auth::guard('user')->login($user);
        return redirect()->route('user.account.verify.form')->with(['message'=>'Registration successfully ! Please Verify Your Account.','class'=>'success']);
    }
    
    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('user');
    }
}
