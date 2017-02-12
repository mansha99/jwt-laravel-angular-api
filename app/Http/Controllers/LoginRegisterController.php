<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;
use App\Http\Utils\MsValidator;

class LoginRegisterController extends Controller {

    public function logout(Request $request) {
        Auth::logout();
        return response()->json([
                    "message" => "success",
        ]);
    }

    public function authenticate(Request $request) {
        $credentials = $request->only('email', 'password');
        $validator = Validator::make($credentials, [
                    'email' => 'required|email|max:80',
                    'password' => 'required|min:6|max:80'
        ]);
        if ($validator->fails()) {
            return response()->json([
                        "message" => "Please correct validation errors",
                        "errors" => MsValidator::ErrorsAssoc($validator)
                            ], 400);
        }
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                            "message" => "Invalid credentials",
                            'error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
                        "message" => "Unknown error, Please try again later",
                        'error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']]);
        session()->put('jwt_token', $token); //   
        $roles = \Illuminate\Support\Facades\Auth::user()->roles;
        $oulist = [];
        foreach ($roles as $role) {
            $oulist[] = $role->name;
        }
        return response()->json(['token' => $token, "roles" => $oulist]);
    }

    public function register(Request $request) {
        // grab credentials from the request
        $credentials = $request->only('email', 'password', 'name');
        $validator = Validator::make($credentials, [
                    'email' => 'required|email|max:80|unique:users',
                    'password' => 'required|min:6|max:80',
                    'name' => 'required|max:80'
        ]);
        if ($validator->fails()) {
            return response()->json([
                        "message" => "Please correct validation errors",
                        "errors" => MsValidator::ErrorsAssoc($validator)
                            ], 400);
        }
        $credentials['password'] = \Illuminate\Support\Facades\Hash::make($credentials['password']);
        $user = \App\User::create($credentials);
        $userRole = \App\Role::where(['name' => 'user'])->first();
        $user->roles()->attach($userRole->id);

        return response()->json(['message' => "account created. Please login"]);
    }

}
