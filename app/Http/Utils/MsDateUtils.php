<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utils;

/**
 * Description of MsDateUtils
 *
 * @author ms10
 */
class MsDateUtils {

    public static function MMDDYYYY_TO_YYYYMMDD($date) {
        $a = explode('-', $date);
        $mm = $a[0];
        $dd = $a[1];
        $yyyy = $a[2];
        return $yyyy . '-' . $mm . '-' . $dd;
    }

    public static function YYYYMMDD_TO_MMDDYYYY($date) {
        $a = explode('-', $date);
        return $a[1] . '-' . $a[2] . '-' . $a[0];
    }

    public static function CompareDate($date1, $date2) {
        return strtotime($date1) - strtotime($date2);
    }

    public static function CompareTime($date1, $date2) {
        return strtotime($date1) - strtotime($date2);
    }

}
