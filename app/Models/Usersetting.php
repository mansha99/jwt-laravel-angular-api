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

}
