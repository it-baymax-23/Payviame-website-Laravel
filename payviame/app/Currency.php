<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    //

    protected $fillable = [
        'currency_code',
        'currency_symbol',
        'currency_description',
        'currency_rate',
    ];

    public function quote() {

        return $this->hasMany('App\Quote');

    }

    public function invoice() {

        return $this->hasMany('App\Invoice');

    }

    public function client() {

        return $this->hasMany('App\Client');

    }

    public function profile() {

        return $this->hasMany('App\Profile');

    }
}
