<?php
Route::get('ashok', 'HomeController@index')->name('front.home');
Route::group(['middleware' => ['user.status','user.email.status']], function() {
    //
    Route::get('/', 'HomeController@index')->name('front.home');
	Route::group(['prefix' => 'information'], function() {
	    Route::get('passport', function (){ return view('front.information.passport'); })->name('front.information.passport');
		Route::get('birth-certificate', function() { return view('front.information.BirthCertificate'); })->name('front.information.BerthCertificate');
		Route::get('driving-licence', function() { return view('front.information.DrivingLicence'); })->name('front.information.DrivingLicence');
		Route::get('pan-card', function() { return view('front.information.PanCard'); })->name('front.information.PanCard');
		Route::get('adhar-card', function() { return view('front.information.AdharCard'); })->name('front.information.AdharCard');
		Route::get('Voter-Id', function (){ return view('front.information.VoterId'); })->name('front.information.VoterId');
	});
	Route::group(['prefix' => 'product'], function() {
		Route::get('details', 'Front\ProductController@show')->name('front.product.details');
	    Route::get('details?name={productName}&category={category}&cid={cid}&iid={piUkey}&pid={ukey}', 'Front\ProductController@show')->name('front.product.details');		    
	    Route::get('medicine', 'MedicineController@index')->name('front.product.medicine');
		Route::post('medicine', 'MedicineController@store')->name('front.product.medicine.post');
		Route::get('category/{category}', 'Front\ProductController@category')->name('front.product.category');
		Route::get('image/{width}/{height}/{quality}/{name}', 'Front\ImageController@product')->name('front.product.image.get');
		Route::get('image/resize/{width}/{height}/{quality}/{name}','Front\ImageController@productResize')->name('front.product.image.resize');
		Route::get('image/{quality}/{name}','Front\ImageController@productOriginal')->name('front.product.image.original');
		Route::get('image2/{width}/{height}/{quality}/{name}', 'Front\ImageController@productOutOfStock')->name('front.product2.image.get');
	});
	Route::group(['prefix' => 'product-of-the-month'], function() {
		Route::get('details/{productName}/{category}/{ukey}', 'Front\ProductController@productOfTheMonth')->name('front.productofthemonth.details');
	});
	Route::get('search', 'Front\ProductController@search')->name('front.product.search.get');
	Route::put('search', 'Front\ProductController@searchAjax')->name('front.product.search.put');

	Route::group(['prefix' => 'cart'], function() {
	    //
	    Route::get('list','Front\CartController@index')->name('front.cart.list');
	    Route::put('add','Front\CartController@create')->name('front.cart.add');
	    Route::get('view/{product}','Front\CartController@show')->name('front.cart.view');
	    Route::put('remove/{product}','Front\CartController@destroy')->name('front.cart.delete');
	    Route::put('update/{cart}','Front\CartController@update')->name('front.cart.update');
	});
	Route::group(['middleware' => ['member','user']], function() {
        Route::group(['prefix' => 'consultancy'], function() {

			Route::get('construction', 'ConstructionController@index')->name('front.consultancy.construction');
			Route::post('construction', 'ConstructionController@store')->name('front.consultancy.construction.post');
			 
			Route::get('educational', 'EducationalController@index')->name('front.consultancy.educational');
			Route::post('educational', 'EducationalController@store')->name('front.consultancy.educational.post');	
			 
		});
		Route::group(['prefix' => 'assistance'], function() {

			Route::get('passport', 'PassportController@index')->name('front.assistance.passport');
			Route::post('passport', 'PassportController@store')->name('front.assistance.passport.post');
			 
			Route::get('pan-card', 'PanController@index')->name('front.assistance.PanCard');
			Route::post('pan-card', 'PanController@store')->name('front.assistance.PanCard.post');

			Route::get('training', 'TrainingController@index')->name('front.assistance.training');
			Route::post('training', 'TrainingController@store')->name('front.assistance.training.post'); 

			Route::get('placement', 'PlacementController@index')->name('front.assistance.placement');
			Route::post('placement', 'PlacementController@store')->name('front.assistance.placement.post'); 
		});
		Route::group(['prefix' => 'services'], function() {

			Route::get('taxi-booking', 'TaxiBookingController@index')->name('front.services.TaxiBooking');
			Route::post('taxi-booking', 'TaxiBookingController@store')->name('front.services.TaxiBooking.post');

			Route::get('recharge', 'RechargeController@index')->name('front.services.recharge');
			Route::post('recharge', 'RechargeController@store')->name('front.services.recharge.post');

			Route::get('it-return', 'ItReturnController@index')->name('front.services.ItReturns');
			Route::post('it-return', 'ItReturnController@store')->name('front.services.ItReturns.post');

			Route::get('Sales-Tax-Registration', 'SalesTaxRegistrationController@index')->name('front.services.SalesTaxRegistration');
			Route::post('Sales-Tax-Registration', 'SalesTaxRegistrationController@store')->name('front.services.SalesTaxRegistration.post');

			Route::get('Service-Tax-Registration', 'ServiceTaxRegistrationController@index')->name('front.services.ServiceTaxRegistration');
			Route::post('Service-Tax-Registration', 'ServiceTaxRegistrationController@store')->name('front.services.ServiceTaxRegistration.post');

			Route::get('dth-services','DthController@index')->name('front.services.dth');
			Route::post('dth-services', 'DthController@store')->name('front.services.dth.post');

			Route::get('utility-bill-payment', 'UtilityBillPaymentController@index')->name('front.services.UtilityBillPayment');
			Route::post('utility-bill-payment', 'UtilityBillPaymentController@store')->name('front.services.UtilityBillPayment.post');
		});
		Route::group(['prefix' => 'product'], function() {
	        Route::get('medicine', 'MedicineController@index')->name('front.product.medicine');
		    Route::post('medicine', 'MedicineController@store')->name('front.product.medicine.post');
	});
		Route::get('checkout','Front\CartController@checkout')->name('front.cart.checkout.form');
		Route::put('checkout/order','Front\CartController@order')->name('front.cart.checkout.order');

    });
	
  
});
Route::get('terms-and-condition', function() {
    return view('front.other.tearmsandcondition');
})->name('front.other.tearmsandcondition');
