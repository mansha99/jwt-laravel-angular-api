<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Utils\MsValidator;
use Auth;
use \Illuminate\Support\Facades\Validator;
use App\Models\Usersetting;

class UserSettingController extends Controller {

    private $paginatePerPage = 10;
    private $user_id;

    public function __construct() {
        // print_r(Auth::user());
    }

    public function index() {
        $list = Usersetting::paginate($this->paginatePerPage);
        return response()->json($list);
    }

    public function store(Request $request) {
        $user_id = Auth::user()->id;
        $data = $request->all();
        $validator = Validator::make($data, [
                    'calperday' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json([
                        "status" => "fail",
                        "errors" => MsValidator::ErrorsAssoc($validator)
                            ], 400);
        }
//        $role = $data['role'];
//        unset($data['role']);
        $data['user_id'] = $user_id;
        $model = Usersetting::create($data);
        return response()->json([
                    "model" => $model,
                    "message" => "Record Saved"
        ]);
    }

    public function update(Request $request, $id) {
        $user_id = Auth::user()->id;
        $model = Usersetting::where(['id' => $id])->first();
        $data = $request->all();
        $validator = Validator::make($data, [
                    'calperday' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json([
                        "status" => "fail",
                        "errors" => MsValidator::ErrorsAssoc($validator),
                            ], 400);
        }
        $data['user_id'] = $user_id;
        $model->fill($data)->save();

        return response()->json([
                    "model" => $model,
                    "message" => "Record Updated"
        ]);
    }

    public function destroy($id) {
        $model = Usersetting::where(['id' => $id])->first();
        $model->delete();
        return response()->json([
                    "message" => "Record Deleted",
                    "id" => $id
        ]);
    }

    public function show($id) {
        
    }

    public function findForUser() {
        $user_id = Auth::user()->id;
        $model = Usersetting::findForUser($user_id);
        return response()->json([
                    "model" => $model
        ]);
    }

}
