<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Calorie;
use \App\Http\Utils\MsValidator;
use Auth;
use \Illuminate\Support\Facades\Validator;

class AdminCalorieController extends Controller {

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

    public function search(Request $request) {
        $data = $request->all();


        $validator = Validator::make($data, [
                    'date_from' => 'required|date_format:m-d-Y',
                    'date_to' => 'required|date_format:m-d-Y',
                    'time_from' => 'required|date_format:H:i',
                    'time_to' => 'required|date_format:H:i'
        ]);
        if ($validator->fails()) {
            return response()->json([
                        "status" => "fail",
                        "message" => "Please correct errors",
                        "errors" => MsValidator::ErrorsAssoc($validator)
                            ], 400);
        }
        $date_from = \App\Http\Utils\MsDateUtils::MMDDYYYY_TO_YYYYMMDD($data['date_from']);
        $date_to = \App\Http\Utils\MsDateUtils::MMDDYYYY_TO_YYYYMMDD($data['date_to']);
        $time_from = $data['time_from'] . ":00";
        $time_to = $data['time_to'] . ":00";
        $errors = [];
        $compare1 = \App\Http\Utils\MsDateUtils::CompareDate($date_from, $date_to);
        $compare2 = \App\Http\Utils\MsDateUtils::CompareTime($time_from, $time_to);
        if ($compare1 > 0) {
            $errors['date_to'] = "Invalid date range selection";
        }
        if ($compare2 > 0) {
            $errors['time_to'] = "Invalid time range selection";
        }

        if (count($errors) > 0) {
            return response()->json([
                        "status" => "fail",
                        "message" => "Please correct errors",
                        "errors" => $errors
                            ], 400);
        }
        //whereBetween('age', [$ageFrom, $ageTo]);
        $list = Calorie::
                where('is_deleted', '!=', 1)
                ->with('user')
                ->orderBy('id', 'DESC')
                ->whereBetween('dt', [$date_from, $date_to])
                ->whereBetween('tm', [$time_from, $time_to])
                ->paginate($this->paginatePerPage);
        $this->__modifyList($list);
        return response()->json($list);
    }

    public function index() {

        $list = Calorie::
                where('is_deleted', '!=', 1)
                ->with('user')
                ->orderBy('id', 'DESC')
                ->paginate($this->paginatePerPage);
        $this->__modifyList($list);
        return response()->json($list);
    }

    public function store(Request $request) {

        $data = $request->all();
        $validator = Validator::make($data, [
                    'txt' => 'required|max:512',
                    'numcalories' => 'required|integer',
                    'dt' => 'required|date_format:m-d-Y',
                    'tm' => 'required|date_format:H:i',
                    'user_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                        "status" => "fail",
                        "errors" => MsValidator::ErrorsAssoc($validator)
                            ], 400);
        }
        $data['is_deleted'] = 0;

        $data['dt'] = \App\Http\Utils\MsDateUtils::MMDDYYYY_TO_YYYYMMDD($data['dt']);
        $model = Calorie::create($data);
        return response()->json([
                    "model" => $model,
                    "message" => "Record Saved"
        ]);
    }

    public function update(Request $request, $id) {

        $data = $request->all();
        $validator = Validator::make($data, [
                    'txt' => 'required|max:512',
                    'numcalories' => 'required|integer',
                    'dt' => 'required|date_format:m-d-Y',
                    'tm' => 'required|date_format:H:i',
                    'user_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                        "status" => "fail",
                        "errors" => MsValidator::ErrorsAssoc($validator),
                            ], 400);
        }
        $data['dt'] = \App\Http\Utils\MsDateUtils::MMDDYYYY_TO_YYYYMMDD($data['dt']);
        $model = Calorie::where(['id' => $id])->first();
        $model->fill($data)->save();
        return response()->json([
                    "model" => $model,
                    "message" => "Record Updated"
        ]);
    }

    public function destroy($id) {

        $model = Calorie::where(['id' => $id])->first();
        $model->delete();
        return response()->json([
                    "message" => "Record Deleted",
                    "id" => $id
        ]);
    }

    public function show($id) {
        
    }

}
