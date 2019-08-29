<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('photos_upload_status_testing','Api\ProductController@photos_upload_status_testing');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('testing', 'Api\ProductController@testing');

Route::post('user_registration', 'Api\LoginController@user_registration');
Route::post('user_login','Api\LoginController@user_login');
Route::post('user_data','Api\LoginController@user_data');
Route::post('check_user_token','Api\LoginController@check_user_token');
Route::post('forgot_password','Api\LoginController@forgot_password');
Route::post('verify_otp','Api\LoginController@verify_otp');
Route::post('change_password','Api\UserController@change_password');
Route::post('category_list','Api\BrandModelController@category_list');
Route::post('brand_list','Api\BrandModelController@brand_list');
Route::post('country_list','Api\BrandModelController@country_list');
Route::post('state_list','Api\BrandModelController@state_list');
Route::post('model_list','Api\BrandModelController@model_list');
Route::post('cc_list','Api\BrandModelController@cc_list');
Route::post('cv_original_list','Api\BrandModelController@cv_original_list');

Route::post('bike_list','Api\ProductController@bike_list');

Route::post('add_motor_cycle','Api\ProductController@add_motor_cycle');
Route::post('update_motor_cycle','Api\ProductController@update_motor_cycle');
Route::post('add_invoice_details','Api\ProductController@add_invoice_details');
Route::post('list_invoice','Api\ProductController@list_invoice');

Route::post('update_invoice_details','Api\ProductController@update_invoice_details');
Route::post('add_photo','Api\ProductController@add_photo');

Route::post('pre_certificate','Api\ProductController@pre_certificate');

Route::post('user_dashboard','Api\ProductController@user_dashboard');
Route::post('mechanic_list','Api\ProductController@mechanic_list');
Route::post('add_mechanic_details','Api\ProductController@add_mechanic_details');
Route::post('add_photo_list','Api\ProductController@add_photo_list');
Route::post('product_detail','Api\ProductController@product_detail');
Route::post('photos_upload_status','Api\ProductController@photos_upload_status');
Route::post('all_product_media_list','Api\ProductController@all_product_media_list');
Route::post('remove_media_from_list','Api\ProductController@remove_media_from_list');
Route::post('product_upload_step_status','Api\ProductController@product_upload_step_status');
Route::post('logout','Api\UserController@user_logout');