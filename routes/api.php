<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'checkToken'],function(){
    Route::post("food/getproducts","App\\Http\\Controllers\\Api\\ProductController@getAllProducts");
    Route::post("food/getcategories","App\\Http\\Controllers\\Api\\ProductController@getAllCategories");
    Route::post("food/getoffers","App\\Http\\Controllers\\Api\\ProductController@getAllOffers");
    Route::post("bill/getbills","App\\Http\\Controllers\\Api\\BillController@getAllBills");
    Route::post("bill/getdeliverycompanies","App\\Http\\Controllers\\Api\\BillController@getDeliveryCompanies");
    Route::post("bill/getdetailbill","App\\Http\\Controllers\\Api\\BillController@getDetailBills");
    Route::post("bill/setdetailbill","App\\Http\\Controllers\\Api\\BillController@setDetailBill");
    Route::post("bill/setbill","App\\Http\\Controllers\\Api\\BillController@setBill");
    Route::post("bill/removebill","App\\Http\\Controllers\\Api\\BillController@removeBill");
    Route::post("user/changename","App\\Http\\Controllers\\Api\\UserController@changename");
    Route::post("user/changephone","App\\Http\\Controllers\\Api\\UserController@changephone");
    Route::post("user/changeemail","App\\Http\\Controllers\\Api\\UserController@changeemail");
    Route::post("user/changepassword","App\\Http\\Controllers\\Api\\UserController@changepassword");

    });

Route::group(['middleware'=>[]],function(){
    Route::post("user/logout","App\\Http\\Controllers\\Api\\UserController@logout");
    Route::post("user/login","App\\Http\\Controllers\\Api\\UserController@login");
});
Route::group(['middleware'=>[]],function(){
    Route::post("user/register","App\\Http\\Controllers\\Api\\UserController@register");
});

