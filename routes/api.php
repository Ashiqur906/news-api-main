<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;

$namespace = 'App\Http\Controllers\Api\v0';

Route::group(['prefix' => 'v0'], function () {
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::post('register', [AuthController::class, 'register']);
    Route::get('test',[AuthController::class, 'test']);
});

Route::group(['middleware' => ['jwt.verify'], 'prefix' => 'v0'], function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('get_user', [AuthController::class, 'get_user']);
});


Route::group(['middleware' => ['jwt.verify'], 'prefix' => 'v0', 'namespace' => $namespace], function () {
    Route::resource('settings', 'SettingController');
    Route::resource('layout-widgets', 'LayoutWidgetController');
    Route::get('l-w-s', 'LayoutWidgetController@layoutWidget');
    Route::get('taxonomy-filter-data', 'LayoutWidgetController@filterData');

    Route::resource('categories', 'CategoryController');
    Route::resource('tags', 'TagController');
    Route::resource('seos', 'SeoController');
    Route::resource('posts', 'PostController');
    Route::resource('socials', 'SocialController');
    Route::resource('widgets', 'WidgetController');
    Route::get('widget/setting', 'WidgetController@setting');
});

Route::group(['middleware' => ['jwt.verify'], 'prefix' => 'v0', 'namespace' => $namespace], function () {
    Route::resource('layouts', 'LayoutController');
    Route::get('layout/status/{path}', 'LayoutController@status');
});

Route::group(['middleware' => ['jwt.verify'], 'prefix' => 'v0', 'namespace' => $namespace], function () {
    Route::get('/get-districts', 'DefaultController@getAllDistrict');
    Route::post('/store-image', 'DefaultController@storeImage');
    Route::get('/images', 'DefaultController@images');
    Route::get('/delete-image/{id}', 'DefaultController@deleteImage');
});

Route::group(['middleware' => ['jwt.verify'], 'prefix' => 'v0', 'namespace' => $namespace], function () {
    Route::post('xml-store', 'XmlController@store');
    Route::get('xml-restore', 'XmlController@restore');
    Route::post('/run-query/{id}','XmlController@callSchedule');
});
