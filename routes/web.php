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


Route::get('/','HomeController@index');
Route::get('/list','HomeController@list');
Route::get('/list/vip','HomeController@listVip');
Route::get('/v','HomeController@view');

Route::group(['middleware'=>'userlogin','prefix' => 'member'],function ()
{
    Route::get('/','HomeController@member');
    Route::get('/vip','HomeController@vip');
    Route::get('/logout','HomeController@logout');
    Route::get('/userinfo','HomeController@userinfo');
});

Route::group(['prefix'=>'mobile'],function(){
    Route::get('/index','MobileController@index');
    Route::get('/list','MobileController@list');
    Route::get('/list/vip','MobileController@listvip');
    Route::get('/reg','MobileController@reg');
    Route::get('/login','MobileController@login');
    Route::get('/v','MobileController@view');

    Route::group(['middleware'=>'userlogin'],function(){
        Route::get('/member','MobileController@member');
        Route::get('/member/userinfo','MobileController@userinfo');
        Route::get('/member/upvip','MobileController@upvip');
    });

});

Route::group(['prefix' => 'api'],function()
{
    Route::get('getHome','ApiController@gethome');
    Route::get('getMobile','ApiController@getMobileHome');
    Route::post('reg','ApiController@createUser');
    Route::post('login','ApiController@loginUser');
    Route::get('getVideoList','ApiController@getVideoListPage');
    Route::get('getUserInfo','ApiController@getUserStatus');
    Route::get('getvideo','ApiController@getVideoAndRand');

    Route::group(['middleware' => 'userlogin'],function(){
        Route::post('getActionCode','ApiController@codeAction');
        Route::post('getUpEmail','ApiController@upEmail');
        Route::post('getUpPwd','ApiController@upPasswd');
        Route::post('getUpUserinfo','ApiController@updateMobileUserInfo');
    });
});



Route::group(['namespace' => 'Admin'],function()
{
    Route::get('/webadminlogin','LoginController@index');
    Route::post('/webadminlogin/gethalt','LoginController@getHalt');


    Route::group(['middleware' => 'adminlogin','prefix'=>'admin'],function()
    {
        Route::get('/htadmin','IndexController@index');
        Route::get('/user','UserController@index');
        Route::get('/vip','UserController@vip');
        Route::get('/setvip','UserController@setVip');
        Route::get('/deleteuser','UserController@delete');
        Route::get('/video','VideoController@index');
        Route::get('/video/setvip','VideoController@setvip');
        Route::get('/video/delete','VideoController@delete');
        Route::get('/videovip','VideoController@vip');
        Route::get('/loading','VideoController@loading');
        Route::get('/video/setok','VideoController@setok');
        Route::get('/videoadd','VideoController@add');
        Route::post('/video/addHalt','VideoController@addHalt');
        Route::get('/links','LinkController@index');
        Route::get('/linksadd','LinkController@add');
        Route::get('/link/delete','LinkController@delete');
        Route::get('/logout','IndexController@logout');
        Route::get('/system','SystemController@index');
        Route::post('/system/addHalt','SystemController@addHalt');
        Route::post('/link/addHalt','LinkController@addHalt');
        Route::get('/code','CodeController@index');
        Route::get('/addcode','CodeController@addcode');
        Route::get('/notice','NoticeController@index');
        Route::get('/noticeadd/','NoticeController@add');
        Route::get('/noticeedit/{id}','NoticeController@edit');
        Route::get('/notice/delete','NoticeController@delete');
        Route::post('/notice/addHalt','NoticeController@addHalt');
        Route::get('/message','MessageController@index');
        Route::post('/message/addHalt','MessageController@addHalt');
    });



});