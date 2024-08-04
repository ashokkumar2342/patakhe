<?php

    // admin routes with prefix admin
    Route::get('/', function() {
        return redirect()->route('admin.login.form');
    });
    Route::group(['middleware' => 'admin.guest'], function() {
    
    // admin authentication routes
    Route::get('auth', 'Auth\LoginController@showLoginForm')->name('admin.login.form');
    Route::post('auth', 'Auth\LoginController@login')->name('admin.login.post');
    
    // admin registration routes
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('admin.register.form');
    Route::post('register', 'Auth\RegisterController@register')->name('admin.register.post');
    
    // admin forget password email routes
    Route::get('password/forget-password', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.forgetPassword.form ');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.forgetPassword.post');
    
    // admin reset password routes
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset.token');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('admin.password.reset.post');
    
    });
    
    Route::group(['middleware' => 'admin'], function() {
        // admin panel  dashboard
        Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
        Route::group(['prefix' => 'catalog'], function() {
            Route::group(['prefix' => 'category'], function() {
                Route::get('/', 'Catalog\CategoryController@index')->name('admin.category.form');
                Route::get('id/{category}', 'Catalog\CategoryController@select')->name('admin.category.select');
                Route::get('get', 'Catalog\CategoryController@getMenu')->name('admin.category.get');
                Route::put('create', 'Catalog\CategoryController@store')->name('admin.category.create');
                Route::get('id/{ukey}/edit', 'Catalog\CategoryController@edit')->name('admin.category.edit');
                Route::put('update/{category}', 'Catalog\CategoryController@update')->name('admin.category.update');
                Route::put('arrange', 'Catalog\CategoryController@arrange')->name('admin.category.arrange');
            }); 
            Route::group(['prefix' => 'special-category'], function() {
                Route::get('/', 'Catalog\SpecialCategoryController@index')->name('admin.category.special.form');
                Route::put('create', 'Catalog\SpecialCategoryController@store')->name('admin.special.category.create');
                Route::get('edit/{ukey}', 'Catalog\SpecialCategoryController@edit')->name('admin.category.special.edit');
                Route::put('update/{category}', 'Catalog\SpecialCategoryController@update')->name('admin.category.special.update');
            });   
            Route::group(['prefix' => 'product'], function() {
                Route::get('/', 'Catalog\ProductController@index')->name('admin.product.list');
                Route::get('/data', 'Catalog\ProductController@productSearch')->name('admin.product.data');
                Route::get('create', 'Catalog\ProductController@create')->name('admin.product.create');
                Route::get('{product}/view', 'Catalog\ProductController@show')->name('admin.product.view');
                Route::put('create', 'Catalog\ProductController@store')->name('admin.product.create.post');
                Route::get('edit/{ukey}', 'Catalog\ProductController@edit')->name('admin.product.edit');
                Route::put('update/{category}', 'Catalog\ProductController@update')->name('admin.product.update');
                Route::group(['prefix' => 'product-of-the-month'], function() {
                    Route::post('{product}/create', 'Catalog\ProductOfTheMonthController@store')->name('admin.product.potm.add');
                });
                Route::group(['prefix' => '{product}/item'], function() {
                    Route::get('list', 'Catalog\ProductItemController@index')->name('admin.product.item.list');
                    Route::get('{productItem}/view', 'Catalog\ProductItemController@show')->name('admin.product.item.view');
                    Route::get('{productItem}/delete', 'Catalog\ProductItemController@destroy')->name('admin.product.item.delete');
                    Route::group(['prefix' => '{productItem}/seller'], function() {
                        Route::get('{sop}/view', 'Catalog\ProductItemController@sop')->name('admin.product.item.sop.view');
                    });
                    
                });
                Route::group(['prefix' => 'special'], function() {
                    Route::get('{sop}/add', 'Catalog\SpecialProductController@store')->name('admin.product.special.add');
                });
            });
            Route::group(['prefix' => 'unit'], function() {
                Route::get('/', 'Catalog\UnitController@index')->name('admin.unit.form');
                Route::get('edit', 'Catalog\UnitController@index')->name('admin.unit.edit');
                Route::post('create', 'Catalog\UnitController@store')->name('admin.unit.post');
                Route::post('{unit}/update', 'Catalog\UnitController@update')->name('admin.unit.update');
                Route::delete('{unit}/delete','Catalog\UnitController@store')->name('admin.unit.delete');
            });
            Route::group(['prefix' => 'color'], function() {
                Route::get('/', 'Catalog\ColorController@index')->name('admin.color.form');
                Route::post('create', 'Catalog\ColorController@store')->name('admin.color.post');
                Route::get('{color}/edit', 'Catalog\ColorController@edit')->name('admin.color.edit');
                Route::post('{color}/update', 'Catalog\ColorController@update')->name('admin.color.update');
                Route::delete('{color}/delete', 'Catalog\ColorController@destroy')->name('admin.color.delete');

            });
           
            

        });
        Route::group(['prefix' => 'consultancy'], function() {
            
            Route::group(['prefix' => 'construction'], function() {
                Route::get('/', 'Consultancy\ConstructionController@index')->name('admin.consultancy.construction');
                Route::get('{construction}/view', 'Consultancy\ConstructionController@show')->name('admin.consultancy.construction.view');
                Route::delete('{construction}/delete', 'Consultancy\ConstructionController@destroy')->name('admin.consultancy.construction.delete');
                Route::put('{construction}/status', 'Consultancy\ConstructionController@status')->name('admin.consultancy.construction.status');
    
            });
            Route::group(['prefix' => 'educational'], function() {
                Route::get('/', 'Consultancy\EducationalController@index')->name('admin.consultancy.educational');
                Route::get('{educational}/view', 'Consultancy\EducationalController@show')->name('admin.consultancy.educational.view');
                Route::delete('{educational}/delete', 'Consultancy\EducationalController@destroy')->name('admin.consultancy.educational.delete');
                Route::put('{educational}/status', 'Consultancy\EducationalController@status')->name('admin.consultancy.educational.status');
    
            });
    
        });
        Route::group(['prefix' => 'assistance'], function() {
    
            Route::group(['prefix' => 'passport'], function() {
                Route::get('/', 'Assistance\PassportController@index')->name('admin.assistance.passport');
                Route::get('{passport}/view', 'Assistance\PassportController@show')->name('admin.assistance.passport.view');
                Route::delete('{passport}/delete', 'Assistance\PassportController@destroy')->name('admin.assistance.passport.delete');
                Route::put('{passport}/status', 'Assistance\PassportController@status')->name('admin.assistance.passport.status');
            });
            Route::group(['prefix' => 'pan-card'], function() {
                Route::get('/', 'Assistance\PanCardController@index')->name('admin.assistance.pancard');
                Route::get('{pan}/view', 'Assistance\PanCardController@show')->name('admin.assistance.pancard.view');
                Route::delete('{pan}/delete', 'Assistance\PanCardController@destroy')->name('admin.assistance.pancard.delete');
                Route::put('{pan}/status', 'Assistance\PanCardController@status')->name('admin.assistance.pancard.status');
            });
            Route::group(['prefix' => 'training'], function() {
                Route::get('/', 'Assistance\TrainingController@index')->name('admin.assistance.training');
                Route::get('{training}/view', 'Assistance\TrainingController@show')->name('admin.assistance.training.view');
                Route::delete('{training}/delete', 'Assistance\TrainingController@destroy')->name('admin.assistance.training.delete');
                Route::put('{training}/status', 'Assistance\TrainingController@status')->name('admin.assistance.training.status');
            });
            Route::group(['prefix' => 'placement'], function() {
                Route::get('/', 'Assistance\PlacementController@index')->name('admin.assistance.placement');
                Route::get('{placement}/view', 'Assistance\PlacementController@show')->name('admin.assistance.placement.view');
                Route::delete('{placement}/delete', 'Assistance\PlacementController@destroy')->name('admin.assistance.placement.delete');
                Route::put('{placement}/status', 'Assistance\PlacementController@status')->name('admin.assistance.placement.status');
            });
        });
        Route::group(['prefix' => 'products'], function() {
    
            Route::group(['prefix' => 'medicine'], function() {
                Route::get('/', 'Catalog\MedicineController@index')->name('admin.product.medicine');
                Route::get('{medicine}/view', 'Catalog\MedicineController@show')->name('admin.product.medicine.view');
                Route::delete('{medicine}/delete', 'Catalog\MedicineController@destroy')->name('admin.product.medicine.delete');
                Route::put('{medicine}/status', 'Catalog\MedicineController@status')->name('admin.product.medicine.status');
            });
            Route::group(['prefix' => 'product-of-the-month'], function() {
                Route::get('/', 'Products\ProductOfTheMonthController@index')->name('admin.product.productofthemonth');
                Route::get('{productOfTheMonth}/view', 'Products\ProductOfTheMonthController@show')->name('admin.product.productofthemonth.views');
                Route::delete('{productOfTheMonth}/delete', 'Products\ProductOfTheMonthController@destroy')->name('admin.product.productofthemonth.delete');
                Route::put('{productOfTheMonth}/status', 'Products\ProductOfTheMonthController@status')->name('admin.product.productofthemonth.status');
            });
            Route::group(['prefix' => 'order'], function() {
                Route::get('/', 'Catalog\OrderController@index')->name('admin.product.order.list');
                Route::get('{order}/view', 'Catalog\OrderController@show')->name('admin.product.order.view');
                Route::put('{order}/status', 'Catalog\OrderController@status')->name('admin.product.order.status');
                Route::get('{order}/cancel', 'Catalog\OrderController@cancelOrder')->name('admin.product.order.cancel');
                Route::delete('{order}/delete', 'Catalog\OrderController@destroy')->name('admin.product.order.delete');
                Route::get('item/{orderItem}/cancel', 'Catalog\OrderController@cancelOrderItem')->name('admin.product.order.item.cancel');

            });
        });
        Route::group(['prefix' => 'services'], function() {
    
            Route::group(['prefix' => 'taxi-service'], function() {
                Route::get('/', 'Services\TaxiController@index')->name('admin.services.taxiservice');
                Route::get('{taxiBooking}/view', 'Services\TaxiController@show')->name('admin.services.taxiservice.view');
                Route::delete('{taxiBooking}/delete', 'Services\TaxiController@destroy')->name('admin.services.taxiservice.delete');
                Route::put('{taxiBooking}/status', 'Services\TaxiController@status')->name('admin.services.taxiservice.status');
            });
            Route::group(['prefix' => 'it-return'], function() {
                Route::get('/', 'Services\ItReturnController@index')->name('admin.services.itreturn');
                Route::get('{itReturn}/view', 'Services\ItReturnController@show')->name('admin.services.itreturn.view');
                Route::delete('{itReturn}/delete', 'Services\ItReturnController@destroy')->name('admin.services.itreturn.delete');
                Route::put('{itReturn}/status', 'Services\ItReturnController@status')->name('admin.services.itreturn.status');
            });
            Route::group(['prefix' => 'recharge'], function() {
                Route::get('/', 'Services\RechargeController@index')->name('admin.services.recharge');
                Route::get('{recharge}/view', 'Services\RechargeController@show')->name('admin.services.recharge.view');
                Route::delete('{recharge}/delete', 'Services\RechargeController@destroy')->name('admin.services.recharge.delete');
                Route::put('{recharge}/status', 'Services\RechargeController@status')->name('admin.services.recharge.status');
            });
            Route::group(['prefix' => 'sales-tax-registration'], function() {
                Route::get('/', 'Services\SalesTaxRegistrationController@index')->name('admin.services.salestaxregistration');
                Route::get('{salesTaxRegistration}/view', 'Services\SalesTaxRegistrationController@show')->name('admin.services.salestaxregistration.view');
                Route::delete('{salesTaxRegistration}/delete', 'Services\SalesTaxRegistrationController@destroy')->name('admin.services.salestaxregistration.delete');
                Route::put('{salesTaxRegistration}/status', 'Services\SalesTaxRegistrationController@status')->name('admin.services.salestaxregistration.status');
            });
            Route::group(['prefix' => 'service-tax-registration'], function() {
                Route::get('/', 'Services\ServiceTaxRegistrationController@index')->name('admin.services.servicetaxregistration');
                Route::get('{serviceTaxRegistration}/view', 'Services\ServiceTaxRegistrationController@show')->name('admin.services.servicetaxregistration.view');
                Route::delete('{serviceTaxRegistration}/delete', 'Services\ServiceTaxRegistrationController@destroy')->name('admin.services.servicetaxregistration.delete');
                Route::put('{serviceTaxRegistration}/status', 'Services\ServiceTaxRegistrationController@status')->name('admin.services.servicetaxregistration.status');
            });
            Route::group(['prefix' => 'dth'], function() {
                Route::get('/', 'Services\DthController@index')->name('admin.services.dthservice');
                Route::get('{dth}/view', 'Services\DthController@show')->name('admin.services.dthservice.view');
                Route::delete('{dth}/delete', 'Services\DthController@destroy')->name('admin.services.dthservice.delete');
                Route::put('{dth}/status', 'Services\DthController@status')->name('admin.services.dthservice.status');
            });
            Route::group(['prefix' => 'utility-bill-payment'], function() {
                Route::get('/', 'Services\UtilityBillPaymentController@index')->name('admin.services.utilitybillpayment');
                Route::get('{utilityBillPayment}/view', 'Services\UtilityBillPaymentController@show')->name('admin.services.utilitybillpayment.view');
                Route::delete('{utilityBillPayment}/delete', 'Services\UtilityBillPaymentController@destroy')->name('admin.services.utilitybillpayment.delete');
                Route::put('{utilityBillPayment}/status', 'Services\UtilityBillPaymentController@status')->name('admin.services.utilitybillpayment.status');
            });
        });
    
        Route::group(['prefix' => 'user'], function() {
            Route::get('new', 'UserController@newUser')->name('admin.user.new.form');
            Route::post('create', 'UserController@store')->name('admin.user.new.post');
            Route::get('{user}/view', 'UserController@show')->name('admin.user.view');
            Route::get('list', 'UserController@lists')->name('admin.user.lists');
            Route::get('{user}/edit', 'UserController@edit')->name('admin.user.edit');
            Route::post('{user}/update', 'UserController@update')->name('admin.user.update');
            Route::delete('{user}/delete', 'UserController@destroy')->name('admin.user.delete');
            Route::put('{user}/status', 'UserController@status')->name('admin.user.status');
            Route::put('{user}/password-reset', 'UserController@passwordReset')->name('admin.user.password.reset');
            
        });
        Route::group(['prefix' => 'member'], function() {
            Route::get('new', 'MemberController@newMember')->name('admin.member.new.form');
            Route::post('create', 'MemberController@store')->name('admin.member.new.post');
            Route::get('{user}/view', 'MemberController@show')->name('admin.member.view');
            Route::get('list', 'MemberController@lists')->name('admin.member.lists');
            Route::get('{user}/edit', 'MemberController@edit')->name('admin.member.edit');
            Route::post('{user}/update', 'MemberController@update')->name('admin.member.update');
            Route::delete('{member}/delete', 'MemberController@destroy')->name('admin.member.delete');
            Route::put('{user}/status', 'MemberController@status')->name('admin.member.status');
            Route::put('{user}/password-reset', 'MemberController@passwordReset')->name('admin.member.password.reset');
    
            Route::group(['prefix' => 'request'], function() {
                Route::get('/', 'MemberRequestController@index')->name('admin.member.request');
                Route::get('{user}/approval', 'MemberRequestController@create')->name('admin.member.request.edit'); 
                Route::put('{user}/submit', 'MemberRequestController@update')->name('admin.member.request.update');       
                Route::delete('{memberRequest}/delete', 'MemberRequestController@destroy')->name('admin.member.request.delete');
            });            
        });
        Route::group(['prefix' => 'sub-member'], function() {
            Route::get('{subMember}/view', 'SubMemberController@show')->name('admin.submember.view');
            Route::get('{subMember}/edit', 'SubMemberController@edit')->name('admin.submember.edit');
            Route::get('{user}/add', 'SubMemberController@index')->name('admin.submember.form');
            Route::post('{user}/add', 'SubMemberController@store')->name('admin.submember.add');
            Route::put('{subMember}/update', 'SubMemberController@update')->name('admin.submember.update');
            Route::delete('{subMember}/delete', 'SubMemberController@destroy')->name('admin.submember.delete');
        });
        Route::group(['prefix' => 'seller'], function() {
            Route::get('new', 'SellerController@newSeller')->name('admin.seller.new.form');
            Route::post('registration', 'SellerController@create')->name('admin.seller.new.post');
            Route::get('list', 'SellerController@index')->name('admin.seller.lists');
            Route::get('{seller}/edit', 'SellerController@edit')->name('admin.seller.edit');
            Route::post('{seller}/update', 'SellerController@update')->name('admin.seller.update');
            Route::delete('{seller}/delete', 'SellerController@destroy')->name('admin.seller.delete');
            Route::put('{seller}/status', 'SellerController@status')->name('admin.seller.status');
            Route::put('{seller}/password-reset', 'SellerController@passwordReset')->name('admin.seller.password.reset');
            
        });
        Route::group(['prefix' => 'trash'], function() {
            Route::group(['prefix' => 'productmenu'], function() {
                Route::get('list', 'ProductMenuController@trashList')->name('admin.trash.productmenu.list');
                Route::put('restore/{id}', 'ProductMenuController@trashRestore')->name('admin.trash.productmenu.restore');
                Route::delete('delete/{id}', 'ProductMenuController@trashDelete')->name('admin.trash.productmenu.delete');
            });
            Route::group(['prefix' => 'category'], function() {
                Route::get('list', 'CategoryController@trashList')->name('admin.trash.category.list');
                Route::put('restore/{id}', 'CategoryController@trashRestore')->name('admin.trash.category.restore');
                Route::delete('delete/{id}', 'CategoryController@trashDelete')->name('admin.trash.category.delete');
            });
            Route::group(['prefix' => 'subcategory'], function() {
                Route::get('list', 'SubCategoryController@trashList')->name('admin.trash.subcategory.list');
                Route::put('restore/{id}', 'SubCategoryController@trashRestore')->name('admin.trash.subcategory.restore');
                Route::delete('delete/{id}', 'SubCategoryController@trashDelete')->name('admin.trash.subcategory.delete');
            });
        });
        Route::group(['prefix' => 'selectoption'], function() {
            Route::post('category/{productMenu}', 'SelectOptionController@category')->name('admin.selectoption.category');
            Route::post('subcategory/{category}', 'SelectOptionController@subCategory')->name('admin.selectoption.subcategory');
        });
    
        Route::group(['prefix' => 'setting'], function() {
            Route::group(['prefix' => 'profile'], function() {
                Route::group(['prefix' => 'information'], function() {
                    Route::get('view', function() {
                        $admin = Auth::guard('admin')->user();
                        return view('admin.account.profile.view',compact('admin'));
                    })->name('admin.account.profile.information.view');
                    Route::get('edit', function() {
                        $admin = Auth::guard('admin')->user();
                        return view('admin.account.profile.information',compact('admin'));
                    })->name('admin.account.profile.information.edit');
                    Route::post('update', 'Account\ProfileController@infoUpdate')->name('admin.account.profile.information.update');
                });
                Route::group(['prefix' => 'picture'], function() {
                    Route::get('edit', function() {
                        $admin = Auth::guard('admin')->user();
                        return view('admin.account.profile.picture',compact('admin'));
                    })->name('admin.account.profile.picture.form');
                    Route::post('update', 'Account\ProfileController@pictureUpdate')->name('admin.account.profile.picture.update');
                });
                Route::get('image/profile/{image}', 'ImageController@profile')->name('admin.image.profile.view');
            });
            Route::group(['prefix' => 'password'], function() {
                //
                Route::get('password', function() {
                    $admin = Auth::guard('admin')->user();
                    return view('admin.account.changePassword',compact('admin'));
                })->name('admin.changepassword.form');
                Route::put('password/update', 'Account\SettingController@changePassword')->name('admin.changepassword.post');
            });
        });
    
        Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout.get');
        Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout.post');
    });