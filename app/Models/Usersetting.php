<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usersetting extends Model {

    protected $table = 'usersettings';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'calperday'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public static function findForUser($user_id) {
        $model = Usersetting::where(['user_id' => $user_id])->first();
        if (!$model) {
            $model = new \App\Models\Usersetting();
            $model->user_id = $user_id;
            $model->calperday = 0;
            $model->save();
            $model = Usersetting::where(['user_id' => $user_id])->first();
        }
        return $model;
    }

}
