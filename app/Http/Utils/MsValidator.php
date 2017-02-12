<?php

namespace App\Http\Utils;


class MsValidator {

    public static function ErrorsAssoc($validator) {
        $e = json_decode(json_encode($validator->messages()));
        $errors = [];
        foreach ($e as $k => $v) {
            $errors[$k] = $v[0];
        }
        return $errors;
    }
   

}
