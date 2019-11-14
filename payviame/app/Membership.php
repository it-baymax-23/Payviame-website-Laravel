<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    //

    protected $fillable = [
        'membership_name', 'user_limit', 'client_limit', 'membership_price',
    ];

    public function users() {

        return $this->hasMany('App\User');

    }
}
