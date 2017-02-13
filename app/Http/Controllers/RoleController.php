<?php

namespace App\Http\Controllers;

class RoleController extends Controller  {
    public function getRoles(){
        $list=  \App\Role::all();
        return response()->json($list);
    }
}
