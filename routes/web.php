<?php

Route::get('/', function () {
    return view('welcome');
});
Route::post('authenticate', 'LoginRegisterController@authenticate');
Route::post('register', 'LoginRegisterController@register');


