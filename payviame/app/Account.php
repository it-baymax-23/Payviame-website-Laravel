<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{

    protected $fillable = [
        'user_id',
    ];

    public function user() {

        return $this->belongsTo('App\User');

    }

    public function team() {

        return $this->hasOne('App\Team');

    }
}
