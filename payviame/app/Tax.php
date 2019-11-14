<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{

    protected $fillable = [
        'user_id',
        'tax_description',
        'tax_percentage',
    ];

    public function user() {

        return $this->belongsTo('App\User');

    }
}
