<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', 'AppController@index')->name('app');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/activity', 'ActivityController@index')->name('activity');
Route::get('/investation', 'InvestationController@index')->name('investation');
Route::get('/notification', 'NotificationController@index')->name('notification');
Route::get('/account', 'AccountController@index')->name('account');
Route::get('/list-item', 'ListItemController@index')->name('list-item');
Route::get('/tracking-order', 'TrackingOrderController@index')->name('tracking-order');
Route::get('/account-info', 'AccountInfoController@index')->name('account-info');
Route::get('/account-verification', 'AccountVerificationController@index')->name('account-verification');
Route::get('/email-verification', 'EmailVerificationController@index')->name('email-verification');
Route::get('/phone-verification', 'PhoneVerificationController@index')->name('phone-verification');
Route::get('/identity-verification', 'IdentityVerificationController@index')->name('identity-verification');
Route::get('/detail-product', 'DetailProductController@index')->name('detail-product');
Route::get('/form-order', 'FormOrderController@index')->name('form-order');
Route::get('/payment', 'PaymentController@index')->name('payment');
Route::get('/after-payment', 'AfterPaymentController@index')->name('after-payment');
Route::get('/rent-product', 'RentProductController@index')->name('rent-product');


