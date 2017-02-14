<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;

class TokenController extends Controller {

    public function getToken() {
        $token = session()->get('jwt_token', null);
        return response()->json(array("token" => $token));
    }

    public function validateToken(Request $request) {

        $user = JWTAuth::parseToken()->authenticate();
        if ($user) {
            $roles = $user->roles;
            $outlist = [];
            foreach ($roles as $role) {
                $outlist[] = $role->name;
            }
            return response()->json(array("user" => $user, "roles" => $outlist, "status" => 'success'));
        } else {
            return response()->json(array("message" => "You are not authorized", "status" => "invalid_token"), 400);
        }
    }

}
