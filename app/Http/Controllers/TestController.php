<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of TestController
 *
 * @author shivay
 */
class TestController extends Controller{
    public function index(){
        print_r(\App\Http\Utils\MsDateUtils::CompareTime("15:30", "14:40"));
    }
}
