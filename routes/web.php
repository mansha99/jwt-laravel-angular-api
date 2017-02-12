<?php

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('welcome');
});


Route::post('authenticate', 'LoginRegisterController@authenticate');
Route::post('register', 'LoginRegisterController@register');
Route::get('logout', 'LoginRegisterController@logout');



Route::get('/page/user', [
    'uses' => 'PageController@user',
    'middleware' => ['auth']
]);
Route::get('/page/admin', [
    'uses' => 'PageController@admin',
    'middleware' => ['auth']
]);
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('validateToken', 'TokenController@validateToken');
    Route::resource('calorie', 'CalorieController');
});


