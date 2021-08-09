<?php
/**
 * Developer : Abdulrahman Mardinli
 * Email : aboodma@gmail.com
 */
use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

Auth::routes();

//Web Routes
    Route::post('like','ProviderPostLikeController@store')->name('like')->middleware('auth');
    Route::post('unlike','ProviderPostLikeController@unlike')->name('unlike')->middleware('auth');
    Route::post('comment','ProviderPostCommentController@comment')->name('comment')->middleware('auth');
    Route::get('search', 'HomeController@search')->name('search');
    Route::get('timeline','HomeController@timeline')->name('timeline');
    Route::get('star/{slug}', 'HomeController@provider_profile')->name('provider_profile');
    Route::get('dashboard', 'HomeController@customer_dashboard')->name('customer_dashboard');
    Route::post('checkout', 'HomeController@checkout')->name('checkout')->middleware('auth');
    Route::post('payment_info', 'HomeController@payment_info')->name('payment_info')->middleware('auth');
    Route::post('pay', 'HomeController@pay')->name('pay')->middleware('auth');
    Route::get('order_copmlete/{order_id}', 'HomeController@order_complete')->name('order_complete');
    Route::get('be_our_partner/', 'HomeController@be_our_partner')->name('be_our_partner');
    Route::post('provider_request', 'HomeController@provider_request')->name('provider_request');
    Route::get('request_submited/{user}', 'HomeController@request_submited')->name('request_submited');
    Route::get('category/{providerType}', 'HomeController@FilterByType')->name('FilterByType');
    Route::get('categories', 'HomeController@categories')->name('categories');
    Route::get('featured', 'HomeController@featured')->name('featured');
    Route::post('reviews', 'HomeController@reviews')->name('reviews');
    Route::post('notify/read', 'NotificationController@read')->name('notify_read');
    Route::get('setLocale/{locale}', 'HomeController@changeLocale')->name('ChangeLocale');
    Route::post('selectPayment', 'HomeController@selectPayment')->name('selectPayment')->middleware('auth');
    Route::post('checkPayment', 'HomeController@checkPayment')->name('checkPayment')->middleware('auth');
    //ws routes
    Route::get('/service_check', 'ProviderServiceController@service_check')->name('service_check');
    Route::post('/book', 'BookController@showBookServices')->name('book_show');
    Route::post('reservation/store',"ReservationController@store")->name('reservation_store')->middleware('auth');

//customer routes
Route::group(['prefix' => 'customer', 'as' => 'customer.', 'middleware' => 'customer'], function () {

    Route::get('profile', 'CustomerController@profile')->name('profile');
    Route::post('UpdatePrfoile', 'CustomerController@UpdatePrfoile')->name('UpdatePrfoile');
    Route::get('order/files/{order}', 'OrderController@customerOrderDownloadFiles')->name('showOrderfiles');
    Route::get('myOrders', 'CustomerController@orders')->name('orders');
    Route::get('OrderTracking/{id}', 'CustomerController@OrderTracking')->name('OrderTracking');
    Route::get('videos', 'CustomerController@videos')->name('videos');
    Route::get('wallet', 'CustomerController@wallet')->name('wallet');
    Route::post('rate', 'OrderReviewController@rateOrder')->name('rate_order');
    Route::get('myFavoritList', 'FavoritController@favorits')->name('myFavoritList');
    Route::post('addToFavorit', 'FavoritController@addToFavorit')->name('addToFavorit');
    Route::post('removeFromFavorit', 'FavoritController@removeFromFavorit')->name('removeFromFavorit');
    Route::post('payForFunds', 'CustomerController@payForFunds')->name('payForFunds');
    Route::post('payFunds', 'CustomerController@payFunds')->name('payFunds');
    Route::get('reservations','ReservationController@customer_index')->name('reservations');
    Route::get('premium','CustomerController@premium_form')->name('premium_form');
    Route::post('premium','CustomerController@premium_activate')->name('premium_activate');
});

//Admin Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    // User Model
    Route::get('/user/edit/{user}', 'AdminController@user_edit')->name('user_edit');
    Route::get('user/view/{user}', 'AdminController@user_view')->name('user_view');
    Route::post('user/update/{user}', 'AdminController@user_update')->name('user_update');
    Route::get('user/create/{user_type}', 'AdminController@user_create')->name('user_create');
    Route::post('user/store/{user_type}', 'AdminController@user_store')->name('user_store');
    Route::delete('user/delete/{user}', 'AdminController@user_delete')->name('user_delete');

    Route::get('/users/customers', 'AdminController@customers')->name('users.customers');
    Route::get('/users/customers/{user}', 'AdminController@customers_show')->name('users.customers_show');
    Route::get('/users/customers/edit/{user}', 'AdminController@customers_edit')->name('users.customers_edit');
    Route::post('/users/customers/update/{user}', 'AdminController@customers_update')->name('users.customers_update');
    Route::delete('/users/customers/delete/{user}', 'AdminController@customers_destroy')->name('users.customers_destroy');

    Route::get('/users/providers', 'AdminController@providers')->name('users.providers');
    Route::get('/users/providers/{user}', 'AdminController@providers_show')->name('users.providers_show');
    Route::get('/users/providers/edit/{user}', 'AdminController@providers_edit')->name('users.providers_edit');
    Route::post('/users/providers/update/{user}', 'AdminController@providers_update')->name('users.providers_update');
    Route::delete('/users/providers/delete/{user}', 'AdminController@providers_destroy')->name('users.providers_destroy');
    Route::get('/users/providers/approve/{provider}', 'AdminController@provider_approve')->name('users.providers_approve');

    // Provider Model
    Route::post('/provider/store/{user_type}', 'ProviderController@store')->name('provider_store');
    Route::post('/provider/update/{user}/{user_type}', 'ProviderController@update')->name('provider_update');
    Route::delete('provider/delete/{user}/{provider}', 'ProviderController@destroy')->name('provider_delete');

    // Service Model
    Route::get('/service/list', 'ServiceController@index')->name('service_list');
    Route::get('/service/create', 'ServiceController@create')->name('service_create');
    Route::post('/service/store', 'ServiceController@store')->name('service_store');
    Route::get('/service/edit/{service}', 'ServiceController@edit')->name('service_edit');
    Route::post('/service/update/{service}', 'ServiceController@update')->name('service_update');
    Route::delete('/service/delete/{service}', 'ServiceController@destroy')->name('service_delete');

    // Categories
    Route::get('/categories', 'ProviderTypeController@index')->name('categories');
    Route::get('/categories/create', 'ProviderTypeController@create')->name('categories_create');
    Route::post('/categories/store', 'ProviderTypeController@store')->name('categories_store');
    Route::get('/categories/edit/{providerType}', 'ProviderTypeController@edit')->name('categories_edit');
    Route::post('/categories/update/{providerType}', 'ProviderTypeController@update')->name('categories_update');
    Route::delete('/categories/delete/{providerType}', 'ProviderTypeController@destroy')->name('categories_delete');

    // Orders
    Route::get('orders', 'OrderController@index')->name('orders');
    Route::get('orders/show/{order}', 'OrderController@show')->name('orders.show');

    //Payout Requests
    Route::get('payouts', 'PayoutRequestController@index')->name('payouts');
    Route::get('payouts/show/{payoutRequest}', 'PayoutRequestController@show')->name('payouts.show');
    Route::get('payouts/accept/{payoutRequest}', 'PayoutRequestController@acceptRequest')->name('payouts.accept');
    Route::post('payouts/reject/', 'PayoutRequestController@reject')->name('payouts.reject');
    Route::post('payouts/paid/', 'PayoutRequestController@paid')->name('payouts.paid');
    // Settings
    Route::get('/Languages', 'LanguageController@index')->name('language.index');
    Route::get('/Languages/translate/{language}', 'LanguageController@translate')->name('language.translate');
    Route::post('/Languages/update/{language}', 'LanguageController@update')->name('language.update');
    Route::get('/Languages/inputs/{locale}', 'InputTransactionController@index')->name('language.inputs');
    Route::post('/Languages/inputs/{locale}/update', 'InputTransactionController@update')->name('language.inputs.update');
    Route::get('/Languages/inputs/{locale}/generate', 'InputTransactionController@generate')->name('language.inputs.generate');

    //Home Page Settings - banners
    Route::get('/HomePage/banners', 'HomePageBannerController@index')->name('homepage.banners');
    Route::get('/HomePage/banners/create', 'HomePageBannerController@create')->name('homepage.banners.create');
    Route::post('/HomePage/banners/store', 'HomePageBannerController@store')->name('homepage.banners.store');
    Route::delete('/HomePage/banners/destroy/{HomePageBanner}', 'HomePageBannerController@destroy')->name('homepage.banners.destroy');
    //Home Page Settings - Categories
    Route::get('/HomePage/categories', 'HomePageProviderTypeController@index')->name('homePage.categories');
    Route::post('/HomePage/category/add', 'HomePageProviderTypeController@store')->name('homePage.categories.store');
    Route::delete('/HomePage/category/destroy/{homePageProviderType}', 'HomePageProviderTypeController@destroy')->name('homePage.categories.destroy');
});

//Provider Routes
Route::group(['prefix' => 'provider', 'as' => 'provider.', 'middleware' => 'provider'], function () {
    Route::get('reservations','ReservationController@provider_index')->name('reservations');
    Route::get('/dashboard', 'ProviderController@dashboard')->name('dashboard');
    Route::get('/profile', 'ProviderController@profile')->name('profile');
    Route::get('/services', 'ProviderController@services')->name('services');
    Route::get('/books', 'BookController@index')->name('books');
    Route::get('/books/create', 'BookController@create')->name('books.create');
    Route::post('/books/store', 'BookController@store')->name('books.store');
    Route::get('/books/service/{book}', 'BookServiceController@create')->name('books.service.create');
    Route::get('/books/edit/{book}', 'BookController@edit')->name('books.service.edit');
    Route::get('/books/show/{book}', 'BookController@show')->name('books.service.show');
    Route::post('/books/update/{book}', 'BookController@update')->name('books.service.update');
    Route::post('/books/service/store/{book}', 'BookServiceController@store')->name('books.service.store');
    Route::delete('/books/service/delete/{bookService}', 'BookServiceController@destroy')->name('books.service.delete');
    Route::get('/orders/{status}', 'ProviderController@orders')->name('orders');
    Route::get('/orders/procced/{order}', 'ProviderController@orders_procced')->name('orders_procced');
    Route::get('/orders/OrderChangeStatus/{status}/{order}', 'ProviderController@OrderChangeStatus')->name('OrderChangeStatus');
    Route::post('/orders/procced/video', 'ProviderController@video_order_upload')->name('video_order_upload');
    Route::post('/orders/procced/other', 'ProviderController@other_order_upload')->name('other_order_upload');
    Route::get('/service/add/{service}', 'ProviderController@add_service')->name('add_service');
    Route::post('/service/store', 'ProviderController@store_service')->name('store_service');
    Route::post('/update/profile', 'ProviderController@update_profile')->name('update_profile');
    Route::get('/wallet', 'WalletController@provider_wallet')->name('wallet');
    Route::get('/payouts', 'PayoutRequestController@provider_payouts')->name('payouts');
    Route::post('/payouts/request', 'PayoutRequestController@provider_payouts_request')->name('payouts_request');
    Route::get('/payment_settings', 'ProviderController@payment_settings')->name('payment_settings');
    Route::post('/payment_settings/update', 'ProviderController@update_payment_settings')->name('update_payment_settings');
    Route::post('showOrderDetails', 'OrderController@showOrderDetails')->name('showOrderDetails');
    Route::get('/service/edit/{providerService}', 'ProviderServiceController@edit')->name('edit_service');
    Route::post('/service/update/{providerService}', 'ProviderServiceController@update')->name('update_service');
    Route::delete('service/delete/{providerService}', 'ProviderServiceController@destroy')->name('delete_service');
    Route::get('book/services/files/{bookService}', 'BookServiceFileController@index')->name('book_service_files');
    Route::post('post/create','ProviderPostController@store')->name('create_post');

});

