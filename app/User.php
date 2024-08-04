<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\UserResetPassword;
use App\Notification\User\EmailVerification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password','mobile','status','gender','dob','address','age','membership_card_no','aadhar_card_no','profile_pic','memeber_type','login_ip','member_status','mobile_verified','email_verified','login_at',
    ];

   
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPassword($token));
    }

    public function member(){
        return $this->hasOne('App\Member','user_id','id');
    }

    public function address(){
        return $this->hasMany('App\Model\User\UserAddress','user_id','id');
    }
    public function default_address(){
        return $this->hasOne('App\Model\User\UserAddress','id','address_id');
    }


}
