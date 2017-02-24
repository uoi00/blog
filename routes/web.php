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

Route::get('/', function () {
    return view('login');
});

//调用验证码
Route::get('/index/captcha/{tmp}', 'ToolController@captcha');
//核对
Route::any('/hd/{y}','ToolController@hd');
//发送邮件
Route::any('/sendmail','ToolController@sendMail');
//用户登录
Route::post('/login','UserController@login');
//用户注册
Route::post('/register','UserController@register');
//找回密码
Route::get('/find','UserController@find');
//用户注销
Route::get('/logout','UserController@logout');

Route::group(['middleware' => 'login'], function () {
    //显示博客主页
    Route::get('/index','IndexController@index');
    //显示我的博文页面
    Route::get('/myblogs','ArticleController@blogList');
    //查看博文
    Route::get('/blog/show/{id}','ArticleController@showBlog');
    //显示添加博文页面
    Route::get('/blog/add','ArticleController@add');
    //博文添加保存
    Route::post('/blog/addsave','ArticleController@addSave');
    //博文搜索
    Route::post('/blog/search','IndexController@search');
    //修改博文
    Route::get('/blog/edit/{id}','ArticleController@editBlog');
    //保存修改
    Route::post('/blog/editsave','ArticleController@editSave');

    //显示心情语录页面
    Route::get('/mymoots','MootController@mootList');
    //显示添加心情页面
    Route::get('/moot/add','MootController@add');
    //心情添加保存
    Route::post('/moot/addsave','MootController@addSave');
    //查看心情
    Route::get('/moot/show/{id}','MootController@show');
    //修改心情
    Route::get('/moot/edit/{id}','MootController@editMoot');
    //保存修改
    Route::post('/moot/editsave','MootController@editSave');
    //删除心情/博文
    Route::post('/moot/del','MootController@deLmoot');
    //博文、心情评论
    Route::post('/blog/comment','ArticleController@comment');

    //显示相册界面
    Route::get('/myphotos','PhotoController@index');
    //添加相册
    Route::get('/photos/add','PhotoController@addPhotos');

});




Route::get('/test','UserController@test');