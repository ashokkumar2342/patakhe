<?php
    Route::get('/', function() {
        //
        return redirect()->route('seller.login.form');
    });
    
    // seller routes with prefix seller
    Route::group(['middleware' => 'seller.guest'], function() {
    // seller authentication redirection
    
    // seller authentication routes
    Route::get('auth', 'Auth\LoginController@showLoginForm')->name('seller.login.form');
    Route::post('auth', 'Auth\LoginController@login')->name('seller.login.post');
    
    // seller registration routes
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('seller.register.form');
    Route::post('register', 'Auth\RegisterController@register')->name('seller.register.post');
    
    // seller forget password email routes
    Route::get('password/forget-password', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.forgetPassword.form ');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('seller.forgetPassword.post');
    
    // seller reset password routes
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('seller.password.reset.token');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('seller.password.reset.post');
    
    });
    // Route::get('account/activation/{token}', 'MobileVerificationController@AccountVerification')->name('seller.account.activation.token.get');
    Route::get('account/email/verification/{token}', 'Account\EmailVerificationController@EmailVerificationGet')->name('seller.email.verification.token.get');
    
    Route::get('account/mobile/verification', function(){ Session::forget('OtpId'); return view('seller.auth.mobileverification'); })->name('seller.mobile.verification.form');
    Route::post('account/mobile/verification/otp/send', 'Account\MobileVerificationController@MobileVerificationPost')->name('seller.mobile.verification.post');
    
    Route::get('account/mobile/verification/otp', function(){ return view('seller.auth.mobileVerificationOtpForm'); })->name('seller.mobile.verification.otp.form');
    Route::post('account/mobile/verification/otp', 'Account\MobileVerificationController@MobileVerificationOTP' )->name('seller.mobile.verification.otp.post');
    // Route::post('account/mobile/verification/otp/resend', 'MobileVerificationController@MobileVerificationOTPResend' )->name('seller.mobile.verification.otp.again.post');
    
    Route::get('account/email/verification', function(){ return view('seller.auth.emailverification'); }  )->name('seller.email.verification.form');
    Route::post('account/email/verification/mail', 'Account\EmailVerificationController@EmailVerificationPost')->name('seller.email.verification.post');
    
    
    Route::group(['middleware' => 'seller'], function() {
        // seller panel  dashboard
    
        Route::get('dashboard', 'DashboardController@index')->name('seller.dashboard');
        // Route::group(['prefix' => 'order'], function() {
        //     //
        //     Route::get('list', 'OrderController@index')->name('seller.order.list');
        // });
        
        Route::group(['prefix' => 'account'], function() {
            //
            Route::group(['prefix' => 'profile'], function() {
                Route::group(['prefix' => 'information'], function() {
                    Route::get('view', function() {
                        $seller = Auth::guard('seller')->user();
                        return view('seller.account.profile.view',compact('seller'));
                    })->name('seller.account.profile.information.view');
                    Route::get('edit', function() {
                        $seller = Auth::guard('seller')->user();
                        return view('seller.account.profile.information',compact('seller'));
                    })->name('seller.account.profile.information.edit');
                    Route::post('update', 'Account\ProfileController@infoUpdate')->name('seller.account.profile.information.update');
                });
                Route::group(['prefix' => 'picture'], function() {
                    Route::get('edit', function() {
                        $seller = Auth::guard('seller')->user();
                        return view('seller.account.profile.picture',compact('seller'));
                    })->name('seller.account.profile.picture.form');
                    Route::post('update', 'Account\ProfileController@pictureUpdate')->name('seller.account.profile.picture.update');
                });
                Route::get('image/profile/{image}', 'ImageController@profile')->name('seller.image.profile.view');
            });
            Route::group(['prefix' => 'setting'], function() {
                //
                Route::get('password', function() {
                    $seller = Auth::guard('seller')->user();
                    return view('seller.account.changePassword',compact('seller'));
                })->name('seller.changepassword.form');
                Route::put('password/update', 'Account\SettingController@changePassword')->name('seller.changepassword.post');
            });
        });
        Route::group(['prefix' => 'category'], function() {
            Route::get('/', 'CategoryController@index')->name('seller.category.get');
            Route::get('search/{category}', 'CategoryController@search')->name('seller.category.search');
            Route::get('find/{category}', 'CategoryController@find')->name('seller.category.find');
        });
        Route::group(['prefix' => 'product'], function() {
            Route::group(['prefix' => '/'], function() {
                Route::get('add', 'ProductController@create')->name('seller.product.add');
                Route::get('list', 'ProductController@index')->name('seller.product.list');
                Route::post('add', 'ProductController@store')->name('seller.product.add.post');        
                Route::post('image', 'ProductController@image')->name('seller.product.image.post');
                Route::put('{product}/status', 'ProductController@status')->name('seller.product.status');
                Route::delete('{product}/delete', 'ProductController@destroy')->name('seller.product.delete');
                // Route::get('{product}/sell', 'ProductController@sell')->name('seller.product.sell');
                // Route::get('sell-on-product/product', 'ProductController@index')->name('seller.allproduct.list');
                 Route::get('{product}/view', 'ProductController@show')->name('seller.product.view');
                Route::get('{product}/edit', 'ProductController@edit')->name('seller.product.edit');
                Route::put('{product}/update', 'ProductController@update')->name('seller.product.update');
                // Route::get('{product}/edit', 'ProductController@edit')->name('seller.product.edit');
                // Route::put('sellOnProduct/{product}', 'ProductController@sellOnProduct')->name('seller.sellonproduct.post');
                Route::put('category/search', 'CategoryController@search')->name('seller.category.search');
                Route::group(['prefix' => '{product}/item'], function() {
                    Route::get('list', 'ProductItemController@index')->name('seller.product.item.list');
                    Route::post('create', 'ProductItemController@store')->name('seller.product.item.create');
                    Route::get('{productItemUkey}/edit', 'ProductItemController@edit')->name('seller.product.item.edit');
                    Route::get('{productItemUkey}/view', 'ProductItemController@show')->name('seller.product.item.view');
                    Route::get('{productItemUkey}/delete', 'ProductItemController@destroy')->name('seller.product.item.delete');
                    Route::post('{productItemUkey}/update', 'ProductItemController@update')->name('seller.product.item.update');
                    Route::post('{productItemUkey}/image/create','ProductItemController@imageAdd')->name('seller.product.item.image.upload');
                    Route::group(['prefix' => '{productItemUkey}/sale'], function() {
                        Route::get('/', 'SellOnProductController@index')->name('seller.product.item.sale');
                        Route::get('{sellUkey}/edit', 'SellOnProductController@edit')->name('seller.product.item.sale.edit');
                        Route::get('{sellUkey}/delete', 'SellOnProductController@destroy')->name('seller.product.item.sale.delete');
                        Route::post('{sellUkey}/update', 'SellOnProductController@update')->name('seller.product.item.sale.update');
                        Route::post('/', 'SellOnProductController@store')->name('seller.product.item.sale.post');

                    });
                });
            });

            // Route::group(['prefix' => 'sell'], function() {
            //     Route::get('/', 'SellOnProductController@index')->name('seller.sop.sell');
            //     // Route::get('list', 'SellOnProductController@lists')->name('seller.sop.list');
            //     Route::get('{product}', 'SellOnProductController@create')->name('seller.sop.select');
            //     Route::post('{product}/create', 'SellOnProductController@store')->name('seller.sop.create.post');
            //     // Route::get('{product}/view', 'SellOnProductController@show')->name('seller.sop.view');
            //     // Route::put('{product}/status', 'SellOnProductController@status')->name('seller.sop.status');
            //     // // Route::get('{sop}/edit', 'SellOnProductController@edit')->name('seller.sop.edit');
            //     // Route::put('update/{sop}', 'SellOnProductController@update')->name('seller.sop.update');
            // });   
            // Route::group(['prefix' => 'special'], function() {
            //     Route::get('add', 'SpecialProductController@create')->name('seller.product.special.add');
            //     Route::get('list', 'SpecialProductController@index')->name('seller.product.special.list');
            //     Route::post('add', 'SpecialProductController@store')->name('seller.product.special.add.post');        
            //     Route::post('image', 'SpecialProductController@image')->name('seller.product.special.image.post');
            // });
        });

        // Route::group(['prefix' => 'product-of-the-month'], function() {
        //         Route::get('/', 'ProductOfTheMonthController@index')->name('seller.potm.list');
        //         Route::get('create', 'ProductOfTheMonthController@create')->name('seller.potm.create');
        //         Route::put('create', 'ProductOfTheMonthController@store')->name('seller.potm.create.post');
        //         Route::get('{productOfTheMonth}/view', 'ProductOfTheMonthController@show')->name('seller.potm.view');
        //         Route::put('{productOfTheMonth}/status', 'ProductOfTheMonthController@status')->name('seller.potm.status');
        //         Route::get('edit/{ukey}', 'ProductOfTheMonthController@edit')->name('seller.potm.edit');
        //         Route::put('update/{category}', 'ProductOfTheMonthController@update')->name('seller.potm.update');
        // });   
        
        // Route::group(['prefix' => 'selectoption'], function() {
        //     // Route::post('category/{productMenu}', 'SelectOptionController@category')->name('seller.selectoption.category');
        //     Route::post('subcategory/{category}', 'SelectOptionController@subCategory')->name('seller.selectoption.subcategory');
        // });
        Route::get('logout', 'Auth\LoginController@logout')->name('seller.logout.get');
        Route::post('logout', 'Auth\LoginController@logout')->name('seller.logout.post');
    });