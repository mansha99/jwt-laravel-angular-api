<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JWTUtils
 *
 * @author ms10
 */

namespace App\Http\Utils;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTUtils {

    public static function TokenForUser($user) {
        return JWTAuth::fromUser($user);
    }

}
