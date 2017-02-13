<?php

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('welcome');
});
Route::get('/mstest', 'TestController@index');

Route::post('authenticate', 'LoginRegisterController@authenticate');
Route::post('register', 'LoginRegisterController@register');
Route::get('logout', 'LoginRegisterController@logout');
Route::get('getRoles', 'RoleController@getRoles');



Route::get('/page/user', [
    'uses' => 'PageController@user',
    'middleware' => ['auth']
]);
Route::get('/page/admin', [
    'uses' => 'PageController@admin',
    'middleware' => ['auth']
]);
Route::get('/page/manager', [
    'uses' => 'PageController@manager',
    'middleware' => ['auth']
]);

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('validateToken', 'TokenController@validateToken');
    Route::get('calorie/search', 'CalorieController@search');
    Route::resource('calorie', 'CalorieController');
    Route::get('admincalorie/search', 'AdminCalorieController@search');
    Route::resource('admincalorie', 'AdminCalorieController');
    Route::get('user/readAll', 'UserController@readAll');   
    Route::resource('user', 'UserController');
    Route::get('usersetting/findForUser', 'UserSettingController@findForUser');
    Route::resource('usersetting', 'UserSettingController');
    
    
});


