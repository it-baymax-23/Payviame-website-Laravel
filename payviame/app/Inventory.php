<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{

    protected $fillable = [
        'user_id',
        'inventory_description',
        'inventory_price',
    ];

    public function user() {

        return $this->belongsTo('App\User');

    }
}
