<?php

// user routes with prefix user
Route::group(['middleware' => 'user.guest'], function() {

// user authentication routes
Route::get('/', function() {
    return redirect()->route('user.login.form');
});
Route::get('auth', 'User\Auth\LoginController@showLoginForm')->name('user.login.form');
Route::get('otp', 'User\Auth\LoginController@otp')->name('user.send.otp');
Route::post('auth', 'User\Auth\LoginController@login')->name('user.login.post');


// user registration routes
Route::get('register', 'User\Auth\RegisterController@showRegistrationForm')->name('user.register.form');
Route::post('register', 'User\Auth\RegisterController@register')->name('user.register.post');

// user forget password request email routes
Route::get('password/forget-password', 'User\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset.form');

Route::post('password/forget-password/email/request', 'User\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.reset.email.post');
Route::post('password/forget-password/mobile/otp', 'User\Auth\ForgotPasswordController@GetOtp')->name('password.reset.mobile.post');
Route::post('password/forget-password/mobile/otp/match', 'User\Auth\ForgotPasswordController@MatchOTP')->name('password.reset.request.post');
Route::post('password/forget-password/change', 'User\Auth\ForgotPasswordController@changePassword')->name('password.reset.change.post');

// user reset password action routes
Route::get('password/reset/{token}', 'User\Auth\ResetPasswordController@showResetForm')->name('user.password.reset.token');
Route::post('password/reset', 'User\Auth\ResetPasswordController@reset')->name('user.password.reset.post');
});

Route::get('account/activation/{token}', 'User\SettingController@AccountVerification')->name('user.account.activation.token.get');
Route::get('account/email/verification/{token}', 'User\Account\EmailVerificationController@getToken')->name('user.email.verification.token.get');

Route::get('account/email/verification', function(){ return view('user.auth.emailverification'); }  )->name('user.email.verification.form');
Route::post('account/email/verification/mail', 'User\Account\EmailVerificationController@PostMail')->name('user.email.verification.post');
Route::put('get-captcha', function(){
        return response()->json(captcha_src());
    });
 Route::get('image/profile/{image}', 'User\ProfileController@getPicture')->name('user.image.profile.view');
// user after login routes protected with middleware guard user
 Route::get('mail', 'User\Auth\RegisterController@mailCheck');



Route::group(['middleware' => ['user','user.status']], function() {
	Route::get('validate', function() {
	   	return redirect()->route('front.home');
	})->name('user.validate');
    Route::get('account/email/verified', 'User\SettingController@CheckEmailVerification')->name('user.email.verification.message');
    // user panel  dashboard
    Route::get('/dashboard', function() {
		echo Auth::guard('user')->user()->name;
    })->name('user.dashboard');


   
    Route::group(['prefix' => 'profile'], function() {
        //
        Route::get('/', 'User\ProfileController@index')->name('user.profile.get');
        Route::get('edit', 'User\ProfileController@edit')->name('user.profile.edit');
        Route::put('update', 'User\ProfileController@update')->name('user.profile.update');
        Route::post('picture/update', 'User\ProfileController@picture')->name('user.profilepic.update');

    });
    Route::group(['prefix' => 'member'], function() {
        //
        Route::post('request', 'User\MemberController@store')->name('user.member.request.post');
    });
    
    Route::group(['prefix' => 'setting'], function() {
        //
        Route::get('/', 'User\SettingController@index')->name('user.setting.get');
    });
    Route::group(['prefix' => 'password'], function() {
        //
        Route::get('/', 'User\ChangePasswordController@index')->name('user.password.change');
        Route::put('/update', 'User\ChangePasswordController@update')->name('user.changepassword.update');
    });
    Route::group(['prefix' => 'cart'], function() {
        //
        Route::get('/', 'User\CartController@index')->name('user.cart.get');
    });

     Route::group(['prefix' => 'review'], function() {
        //
        Route::get('/', 'User\ReviewController@index')->name('user.review.post');        
        Route::post('request', 'User\ReviewController@store')->name('user.profile.review.post');
        Route::get('{review}/delete', 'User\ReviewController@destroy')->name('user.profile.review.delete');         
        Route::get('edit/{review}', 'User\ReviewController@edit')->name('user.profile.review.edit');
        Route::put('update/{review}', 'User\ReviewController@update')->name('user.profile.review.update');

    });
    
    Route::group(['prefix' => 'wishlist'], function() {
        //
        Route::get('/', 'User\WishlistController@index')->name('user.wishlist.get');
    });
});
Route::group(['middleware' => 'user.status'], function() {
    //
    Route::post('account/verify/otp/resend', 'User\SettingController@resendOtp')->name('user.account.resend.otp');
    Route::get('account/verify', 'User\SettingController@AccountVerificationForm')->name('user.account.verify.form');
    // Route::get('account/verify', 'User\SettingController@AccountVerificationForm')->name('user.account.verify.get');
    Route::post('account/verify', 'User\SettingController@AccountVerificationPost')->name('user.account.verify.post');
    Route::put('account/resend/otp', 'User\SettingController@AccountVerificationResendOtp')->name('user.account.otp.resend');
    Route::get('logout', 'User\Auth\LoginController@logout')->name('user.logout.get');
    Route::post('logout', 'User\Auth\LoginController@logout')->name('user.logout.post');
});


 Route::group(['prefix' => 'order'], function() {
        //
        Route::get('/', 'User\OrderController@index')->name('user.orderlist.post');
        Route::get('{order}/view', 'User\OrderController@show')->name('user.order.view'); 
        Route::get('{order}/cancel', 'User\OrderController@cancel')->name('user.order.cancel'); 
        Route::get('item/{orderItem}/cancel', 'User\OrderController@orderItemCancel')->name('user.order.item.cancel');

            

        // Route::get('/', 'User\OrderController@view')->name('user.orderview.post');

        // Route::post('request', 'User\ReviewController@store')->name('user.profile.review.post');
        // Route::get('{review}/delete', 'User\ReviewController@destroy')->name('user.profile.review.delete');         
        // Route::get('edit/{review}', 'User\ReviewController@edit')->name('user.profile.review.edit');
        // Route::put('update/{review}', 'User\ReviewController@update')->name('user.profile.review.update');

    });
