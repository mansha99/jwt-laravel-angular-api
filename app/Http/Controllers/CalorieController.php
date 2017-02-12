<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Calorie;
use \App\Http\Utils\MsValidator;
use Auth;
use \Illuminate\Support\Facades\Validator;

class CalorieController extends Controller {

    private $paginatePerPage = 10;

    private function __modifyList(&$list) {
        foreach ($list as $row) {
            $this->__modify($row);
        }
    }

    private function __modify(&$row) {
        $row->dt = \App\Http\Utils\MsDateUtils::YYYYMMDD_TO_MMDDYYYY($row->dt);
        $row->tm = substr($row->tm, 0, strlen($row->tm) - 3);
    }

    public function index() {

        $user_id = Auth::user()->id;
        $list = Calorie::
                where('is_deleted', '!=', 1)->
                where('user_id', $user_id)
                ->orderBy('id', 'DESC')
                ->paginate($this->paginatePerPage);
        $this->__modifyList($list);
        return response()->json($list);
    }

    public function store(Request $request) {
        $user_id = Auth::user()->id;
        $data = $request->all();
        $validator = Validator::make($data, [
                    'txt' => 'required|max:512',
                    'numcalories' => 'required|integer',
                    'dt' => 'required|date_format:m-d-Y',
                    'tm' => 'required|date_format:H:i'
        ]);
        if ($validator->fails()) {
            return response()->json([
                        "status" => "fail",
                        "errors" => MsValidator::ErrorsAssoc($validator)
                            ], 400);
        }
        $data['is_deleted'] = 0;
        $data['user_id'] = $user_id;
        $data['dt'] = \App\Http\Utils\MsDateUtils::MMDDYYYY_TO_YYYYMMDD($data['dt']);
        $model = Calorie::create($data);
        return response()->json([
                    "model" => $model,
                    "message" => "Record Saved"
        ]);
    }

    public function update(Request $request, $id) {
        $user_id = Auth::user()->id;
        $data = $request->all();
        $validator = Validator::make($data, [
                    'txt' => 'required|max:512',
                    'numcalories' => 'required|integer',
                    'dt' => 'required|date_format:m-d-Y',
                    'tm' => 'required|date_format:H:i'
        ]);
        if ($validator->fails()) {
            return response()->json([
                        "status" => "fail",
                        "errors" => MsValidator::ErrorsAssoc($validator),
                            ], 400);
        }
        $data['dt'] = \App\Http\Utils\MsDateUtils::MMDDYYYY_TO_YYYYMMDD($data['dt']);
        $model = Calorie::where(['id' => $id, "user_id" => $user_id])->first();
        $model->fill($data)->save();
        return response()->json([
                    "model" => $model,
                    "message" => "Record Updated"
        ]);
    }

    public function destroy($id) {
        $user_id = Auth::user()->id;
        $model = Calorie::where(['id' => $id, "user_id" => $user_id])->first();
        $model->delete();
        return response()->json([
                    "message" => "Record Deleted",
                    "id"=>$id
        ]);
    }

    public function show($id) {
        
    }

}
