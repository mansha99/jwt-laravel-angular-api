<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calorie extends Model {

    protected $table = 'calories';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'txt',
        'numcalories',
        'dt',
        'tm',
        'is_deleted'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

}
