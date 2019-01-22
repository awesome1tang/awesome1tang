<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the checkteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//首页路由设置
Route::get('/','Home\IndexController@index');

Route::get('home/login','Home\IndexController@login')->name('home/login');

Route::get('home/register','Home\IndexController@register')->name('home/register');

Route::get('home/time_action','Home\IndexController@time_action');

Route::get('home/fill_money','Home\IndexController@fill_money');

Route::get('home/fill_cart','Home\IndexController@fill_cart');

Route::get('home/sendmoney','Home\IndexController@showdetail');

Route::post('home/search','Home\IndexController@search')->name('home/search');



//后台路由设置
Route::get('/admin/index','Admin\IndexController@index')->name('index');

Route::get('/admin/login','Admin\indexController@login');


Route::group([],function(){
Route::post('/check',['uses'=>'Admin\indexController@check','as'=>'check']);
});

//后台内容模块开始编写-----广告


Route::get('/admin/advert_add','Admin\AdvertController@advert_add')->name('advert_add');



Route::any('/admin/advert_show','Admin\AdvertController@advert_show')->name('advert_show');


Route::any('/admin/advert_get','Admin\AdvertController@advert_get')->name('advert_get');



Route::any('/admin/advert_test','Admin\AdvertController@advert_test')->name('advert_test');


Route::get('/admin/advert_delete','Admin\AdvertController@advert_delete')->name('advert_delete');


Route::get('/admin/advert_status','Admin\AdvertController@advert_status')->name('advert_status');



Route::any('/admin/advert_status','Admin\AdvertController@advert_status')->name('advert_status');


//验证码机制        全站使用


Route::any('/admin/captcha','Admin\CaptchaController@captcha_create')->name('captcha_create');

Route::any('/admin/captcha_check','Admin\CaptchaController@captcha_check')->name('captcha_check');
