<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use \App\Http\Utils\MsValidator;
use Auth;
use \Illuminate\Support\Facades\Validator;

class UserController extends Controller {

    private $paginatePerPage = 10;

    public function readAll() {
        $list = User::select('id', 'name', 'email')
                        ->whereHas('roles', function ($query) {
                            $query->where('name', '=', 'user');
                        })
                        ->with('roles')
                        ->orderBy('name', 'ASC')->get();
        return response()->json($list);
    }

    public function index() {
        $list = User::select('id', 'name', 'email')
                ->whereHas('roles', function ($query) {
                    $query->where('name', '=', 'user');
                })
                ->with('roles')
                ->orderBy('name', 'ASC')
                ->paginate($this->paginatePerPage);
        return response()->json($list);
    }

    public function store(Request $request) {

        $data = $request->all();
        $validator = Validator::make($data, [
                    'name' => 'required|max:512',
                    'email' => 'required|email|max:190|unique:users'
        ]);
        if ($validator->fails()) {
            return response()->json([
                        "status" => "fail",
                        "errors" => MsValidator::ErrorsAssoc($validator)
                            ], 400);
        }
//        $role = $data['role'];
//        unset($data['role']);
        $password = \App\Http\Utils\MsRand::generateRandomString();
        $password = "123456";
        $data['password'] = \Illuminate\Support\Facades\Hash::make($password);
        $model = User::create($data);
        $userRole = \App\Role::where(['name' => 'user'])->first();
        $model->roles()->attach($userRole->id);
        return response()->json([
                    "model" => User::where(['id' => $model->id])->with('roles')->first(),
                    "message" => "Record Saved"
        ]);
    }

    public function update(Request $request, $id) {
        $model = User::where(['id' => $id])->first();
        $data = $request->all();
        $validator = Validator::make($data, [
                    'name' => 'required|max:512',
                    'email' => 'required|email|max:190|unique:users,email,' . $model->id,
//                    'role' => 'required|max:15',
        ]);
        if ($validator->fails()) {
            return response()->json([
                        "status" => "fail",
                        "errors" => MsValidator::ErrorsAssoc($validator),
                            ], 400);
        }
        $model->fill($data)->save();
//        $role = $data['role'];
//        unset($data['role']);
//        $roles = $model->roles();
//        if (!$roles[0]->name == $role) {
//            $roles[0]->delete();
//            $userRole = \App\Role::where(['name' => $role])->first();
//            $roles->attach($userRole->id);
//        }
        return response()->json([
                    "model" => User::where(['id' => $model->id])->with('roles')->first(),
                    "message" => "Record Updated"
        ]);
    }

    public function destroy($id) {

        $model = User::where(['id' => $id])->first();
        $model->delete();
        return response()->json([
                    "message" => "Record Deleted",
                    "id" => $id
        ]);
    }

    public function show($id) {
        
    }

}
