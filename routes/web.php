<?php

/*
|---------------------------------------------------
| Web Routes
|---------------------------------------------------
|
| Author : juman
| Version : 1.0.0
|
*/


/****************************************************************/
/********************	Frontend start	*************************/
/****************************************************************/

// Basic installation route for justfood
Route::get('/justfood-clear', 'InstallController@clear');
Route::get('/justfood-install', 'InstallController@index');
Route::get('/justfood-db-reset', 'InstallController@resetTable');


// All frontend route under the System & maintenance middleware
Route::group(['middleware'=>['system','maintenance']],function(){

	// Routes for home page
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/home', 'HomeController@index')->name('home');

	// Routes for menu page
	Route::get('/menu', 'MenuController@index')->name('menu');
	Route::get('/menu/{id}', 'MenuController@index')->name('menu');
	Route::post('/item/catItem', 'MenuController@catItem');
	Route::post('/item/catItemMb', 'MenuController@catItemMb');
	Route::post('/item/subVar', 'MenuController@subVar');
	Route::post('/checkPostcode', 'MenuController@checkPostcode');
	Route::get('/changeMethod', 'MenuController@changeMethod');
	Route::post('/checkCouponCode', 'MenuController@checkCouponCode');
    Route::get('/searchPostcode','MenuController@getPostcodeForSuggest');

	// Route for download menu
	Route::get('/menu-download', 'PagesController@getDownload')->name('menu-download');

	// Route for gallery page
	Route::get('/gallery', 'PagesController@gallery')->name('gallery');

	// Routes for contact page
	Route::get('/contact', 'PagesController@contact')->name('contact');
	Route::post('/contactSubmit', 'PagesController@submitContact');

	// Routes for Book a table page
	Route::get('/table-reservation', 'PagesController@bookTable')->name('table-reservation');
	Route::post('/submitBookTable', 'PagesController@submitBookTable');

	// Route for term page
	Route::get('/terms', 'PagesController@terms')->name('terms');

	// Route for privacy page
	Route::get('/privacy', 'PagesController@privacy')->name('privacy');

	// Route for faq page
	Route::get('/faq', 'PagesController@faq')->name('faq');

	// Routes for Customer Authentication
	Route::post('/customer/store','CustomerController@store');
	Route::get('/customer/change/{id}','CustomerController@change');
	Route::get('/customer/changeCusStatus','CustomerController@changeCusStatus');
	Route::get('/customer/checkEmail','CustomerController@checkEmail');
	Route::post('/customer/login','CustomerController@login');
	Route::get('/customer/logout','CustomerController@logout');

	// Routes for cart section
    Route::post('/cart/store','CartController@store');
    Route::post('/cart/storeFreeItem','CartController@storeFreeItem');
    Route::post('/cart/update','CartController@update');
    Route::get('/cart/all','CartController@cartAllData');
    Route::get('/cart/delete','CartController@cartalldelete');

	// Route for order
    Route::post('/order','CartController@order');

	// Route for checkout
    Route::post('/checkout','CartController@checkout');

	// Routes for payment
	Route::get('cancel', 'CartController@cancel')->name('payment.cancel');
	Route::get('payment/success/{id}', 'CartController@success')->name('payment.success');
    Route::get('/success','CartController@success')->name('success');
    Route::post('/stripe', 'CartController@stripePost')->name('stripe.post');

    // Routes for customer profile dashboard
	Route::get('/pre-orders','ProfileController@preOrders')->middleware('AuthCustomer');
	Route::get('/pre-orders/{id}', 'ProfileController@viewOrderDetails')->middleware('AuthCustomer');
	Route::get('/profile','ProfileController@index')->middleware('AuthCustomer');
	Route::post('/profile/changePassword','ProfileController@changePassword')->middleware('AuthCustomer');
	Route::post('/profile/editProfile','ProfileController@editProfile')->middleware('AuthCustomer');

	Route::get('/unlink','PagesController@unlink');

});

// All Routes for Error pages
Route::group(['middleware'=>['system']],function(){

	Route::get('/blank', 'HomeController@blank')->name('blank');

});


/****************************************************************/
/********************	Frontend End	*************************/
/****************************************************************/




/****************************************************************/
/********************	Backend start	*************************/
/****************************************************************/

Auth::routes();
// All backend route under the System & Auth middleware
Route::group(['middleware'=>['auth','system']],function(){

	// Route for dashboard page
	Route::get('/dashboard', 'Backend\DashboardController@index')->name('dashboard');

	// Route for slider section
	Route::resource('/backoffice/slider', 'Backend\SliderController');
	Route::POST('/backoffice/SliderController/updateSliderStatus', 'Backend\SliderController@updateSliderStatus');
	Route::POST('/backoffice/SliderController/sliderSorts', 'Backend\SliderController@sliderSorts');
	Route::POST('/backoffice/SliderController/deleteSlider', 'Backend\SliderController@deleteSlider');

	// Route for gallery section
	Route::resource('/backoffice/gallery', 'Backend\GalleryController');
	Route::POST('/backoffice/GalleryController/updateGalleryStatus', 'Backend\GalleryController@updateGalleryStatus');
	Route::POST('/backoffice/GalleryController/gallerySorts', 'Backend\GalleryController@gallerySorts');
	Route::POST('/backoffice/GalleryController/deleteGallery', 'Backend\GalleryController@deleteGallery');

	// Route for Theme/Site settings
	Route::get('/backoffice/settings/site', 'Backend\SiteSettingController@index')->name('site');
	Route::post('/backoffice/settings/storeSocialLink', 'Backend\SiteSettingController@storeSocialLink');
	Route::post('/backoffice/settings/storeSiteBasic', 'Backend\SiteSettingController@storeSiteBasic');

	// Route for restaurant open close & maintainance delivery & collection & extra charge section
	Route::get('/backoffice/otherSettings/openClose', 'Backend\RestaurantOpenCloseController@index')->name('openClose');
	Route::post('/backoffice/otherSettings/updateOpenCloseStatus', 'Backend\RestaurantOpenCloseController@updateOpenCloseStatus')->name('updateOpenCloseStatus');
	Route::post('/backoffice/otherSettings/updateOpenCloseData', 'Backend\RestaurantOpenCloseController@updateOpenCloseData')->name('updateOpenCloseData');
	Route::get('/backoffice/otherSettings/maintainance', 'Backend\DeliveryCollectionOtherController@index')->name('maintainance');
	Route::post('/backoffice/otherSettings/updateData', 'Backend\DeliveryCollectionOtherController@updateData');
	Route::get('/backoffice/otherSettings/extraCharge', 'Backend\ExtraChargeController@index')->name('extraCharge');
	Route::post('/backoffice/otherSettings/update', 'Backend\ExtraChargeController@update');

	// Route for Customer section
	Route::get('/backoffice/customers', 'Backend\CustomerController@index')->name('customers');
	Route::get('/backoffice/customer/{id}', 'Backend\CustomerController@delete');
	Route::POST('/backoffice/updateCustomerStatus', 'Backend\CustomerController@updateCustomerStatus');

	//  Route for item variance sub variance section
	Route::resource('/backoffice/food/category', 'Backend\CategoryController');
	Route::POST('/backoffice/food/categorySorts', 'Backend\CategoryController@categorySorts');
	Route::POST('/backoffice/food/updateCategoryStatus', 'Backend\CategoryController@updateCategoryStatus');
	Route::resource('/backoffice/food/item', 'Backend\ItemController');
	Route::POST('/backoffice/food/itemSorts', 'Backend\ItemController@itemSorts');
	Route::POST('/backoffice/food/updateItemStatus', 'Backend\ItemController@updateItemStatus');

	// Route for variance section
	Route::resource('/backoffice/food/variance', 'Backend\VarianceController');
	Route::post('/backoffice/food/statusupdate', 'Backend\VarianceController@statusupdate');
	Route::get('/backoffice/food/tableData', 'Backend\VarianceController@tableData');
	Route::get('/backoffice/food/suggestVariance', 'Backend\VarianceController@suggestVariance')->name('suggestVariance');
	Route::POST('/backoffice/food/itemVarianceSorts', 'Backend\VarianceController@itemVarianceSorts');

	// Route for sub item & sub item variance section
	Route::resource('/backoffice/food/subitem', 'Backend\SubitemController');
	Route::post('/backoffice/food/statusSubItem', 'Backend\SubitemController@statusSubItem');
	Route::get('/backoffice/food/subItemTableData', 'Backend\SubitemController@subItemTableData');
	Route::POST('/backoffice/food/itemSubItemSorts', 'Backend\SubitemController@itemSubItemSorts');
	Route::get('/backoffice/food/addSubVariance/{id}', 'Backend\SubitemController@addSubVariance');
	Route::get('/backoffice/food/subVarianceTable/{id}', 'Backend\SubitemController@subVarianceTable');
	Route::get('/backoffice/food/editSubVariance/{id}', 'Backend\SubitemController@editSubVariance');
	Route::post('/backoffice/food/updateSubVariance', 'Backend\SubitemController@updateSubVariance');
	Route::post('/backoffice/food/storeSubVariance', 'Backend\SubitemController@storeSubVariance');
	Route::post('/backoffice/food/statusSubVariance', 'Backend\SubitemController@statusSubVariance');
	Route::get('/backoffice/food/subvariance/{id}', 'Backend\SubitemController@subvariance');
	Route::get('/backoffice/food/addItem/{id}', 'Backend\SubitemController@addItem');
	Route::get('/backoffice/food/itemSubVariance/{id}', 'Backend\SubitemController@itemSubVariance');
	Route::get('/backoffice/food/deleteSubItemVariance/{id}', 'Backend\SubitemController@deleteSubItemVariance');
	Route::post('/backoffice/food/storeItem', 'Backend\SubitemController@storeItem');
	Route::post('/backoffice/food/subvarstatusupdate', 'Backend\SubitemController@subvarstatusupdate');
	Route::POST('/backoffice/food/subItemSorts', 'Backend\SubitemController@subItemSorts');
	Route::get('/backoffice/food/itemSVdelete/{id}', 'Backend\SubitemController@itemSVdelete');
	Route::get('/backoffice/food/itemVdelete/{id}', 'Backend\SubitemController@itemVdelete');

	//  Route for order section
	Route::resource('/backoffice/order', 'Backend\OrderController');
	Route::get('/backoffice/orders/pending', 'Backend\OrderController@pending_method');
	Route::get('/backoffice/orders/processing', 'Backend\OrderController@processing');
	Route::get('/backoffice/orders/delivered', 'Backend\OrderController@delivered');
	Route::get('/backoffice/orders/cancelled', 'Backend\OrderController@cancelled');
	Route::get('/backoffice/orders/not_paid', 'Backend\OrderController@not_paid');
	Route::POST('/backoffice/orders/changeStatus', 'Backend\OrderController@changeStatus');
	Route::POST('/backoffice/orders/filter', 'Backend\OrderController@filter');
	Route::POST('/backoffice/orders/date-filter', 'Backend\OrderController@date_filter');

	// Route for Postcode section
	Route::resource('/backoffice/postcodeormileage/postcode', 'Backend\PostcodeController');
	Route::post('/backoffice/postcodeormileage/statusupdate', 'Backend\PostcodeController@statusupdate');
	Route::get('/backoffice/postcodeormileage/tableData', 'Backend\PostcodeController@tableData');

	// Route for Mileage section
	Route::resource('/backoffice/postcodeormileage/mileage', 'Backend\MileageController');
	Route::post('/backoffice/postcodeormileage/mileagestatusupdate', 'Backend\MileageController@mileagestatusupdate');
	Route::get('/backoffice/postcodeormileage/mileageTableData', 'Backend\MileageController@tableData');

	// Route for Allergy section
	Route::resource('/backoffice/allergysection/allergy', 'Backend\AllergyController');
	Route::post('/backoffice/allergysection/allergystatusupdate', 'Backend\AllergyController@allergystatusupdate');
	Route::get('/backoffice/allergysection/allergyTableData', 'Backend\AllergyController@allergyTableData');

	// Route for Store settings section
	Route::get('/backoffice/settings/store', 'Backend\StoreSettingController@index')->name('store');
	Route::post('/backoffice/settings/insertStoreInfo', 'Backend\StoreSettingController@insertStoreInfo');

	// Route for Payment settings section
	Route::get('/backoffice/payment/managePayment', 'Backend\PaymentSettingController@index')->name('managePayment');
	Route::post('/backoffice/payment/storeManagePayment', 'Backend\PaymentSettingController@storeManagePayment');
	Route::post('/backoffice/payment/storePaypalInfo', 'Backend\PaymentSettingController@storePaypalInfo');
	Route::post('/backoffice/payment/storeStripeInfo', 'Backend\PaymentSettingController@storeStripeInfo');	

	// Route for Page settings section
	Route::get('/backoffice/pagesettings/homePage', 'Backend\PageSettingController@index')->name('homePage');
	Route::post('/backoffice/pagesettings/storeHomeInfo', 'Backend\PageSettingController@storeHomeInfo');
	Route::get('/backoffice/pagesettings/menuPage', 'Backend\PageSettingController@menuPage')->name('menuPage');
	Route::post('/backoffice/pagesettings/storeMenuInfo', 'Backend\PageSettingController@storeMenuInfo');
	Route::get('/backoffice/pagesettings/galleryPage', 'Backend\PageSettingController@galleryPage')->name('galleryPage');
	Route::post('/backoffice/pagesettings/storeGalleryInfo', 'Backend\PageSettingController@storeGalleryInfo');
	Route::get('/backoffice/pagesettings/contactPage', 'Backend\PageSettingController@contactPage')->name('contactPage');
	Route::post('/backoffice/pagesettings/storeContactInfo', 'Backend\PageSettingController@storeContactInfo');
	Route::get('/backoffice/pagesettings/termsPage', 'Backend\PageSettingController@termsPage')->name('termsPage');
	Route::post('/backoffice/pagesettings/storeTermInfo', 'Backend\PageSettingController@storeTermInfo');
	Route::get('/backoffice/pagesettings/privacyPage', 'Backend\PageSettingController@privacyPage')->name('privacyPage');
	Route::post('/backoffice/pagesettings/storePrivacyInfo', 'Backend\PageSettingController@storePrivacyInfo');
	Route::get('/backoffice/pagesettings/faqPage', 'Backend\PageSettingController@faqPage')->name('faqPage');
	Route::post('/backoffice/pagesettings/storeFaqs', 'Backend\PageSettingController@storeFaqs');
	Route::POST('/backoffice/pagesettings/updateFaqStatus', 'Backend\PageSettingController@updateFaqStatus');
	Route::POST('/backoffice/pagesettings/faqSorts', 'Backend\PageSettingController@faqSorts');
	Route::POST('/backoffice/pagesettings/deleteFaq', 'Backend\PageSettingController@deleteFaq');

	// Route for Offer section
	Route::resource('/backoffice/offer', 'Backend\OfferController');
	Route::POST('/backoffice/offer/sorts', 'Backend\OfferController@sorts');
	Route::POST('/backoffice/offer/updateStatus', 'Backend\OfferController@updateStatus');

	// Route for Profile section
	Route::get('/backoffice/profile', 'Backend\DashboardController@profile')->name('adminProfile');
	Route::post('/backoffice/changePassword', 'Backend\DashboardController@changePassword');
	Route::get('/backoffice/dashboard/tableData', 'Backend\DashboardController@tableData');
	Route::get('/backoffice/dashboard/userDelete/{id}', 'Backend\DashboardController@userDelete');
	Route::POST('/backoffice/dashboard/userstatusupdate', 'Backend\DashboardController@userstatusupdate');
	Route::POST('/backoffice/dashboard/addUser', 'Backend\DashboardController@addUser');

	// Route for Contact messages section
	Route::get('/backoffice/contact', 'Backend\ContactController@index');
	Route::get('/backoffice/contact/delete', 'Backend\ContactController@delete');
	Route::post('/backoffice/contact/replyMessage', 'Backend\ContactController@replyMessage');

});


/****************************************************************/
/********************	Backend start	*************************/
/****************************************************************/


/*
|-----------------------------
| Printing Software Api Routes
|-----------------------------
|
| Author : Juman Muhammad
| Version : 1.0.0
|
*/

Route::post('/print/api/orders','Printapi\ApiController@index');
Route::post('/print/api/order/show','Printapi\ApiController@show');