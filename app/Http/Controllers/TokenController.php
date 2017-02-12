<?php

namespace App\Http\Controllers;

class TokenController extends Controller {

    public function getToken() {
        $token = session()->get('jwt_token', null);
        return response()->json(array("token" => $token));
    }

}
