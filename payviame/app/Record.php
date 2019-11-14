<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //

    protected $fillable = [
        'invoice_id',
        'pay_value',
        'pay_date',
        'pay_description',
    ];

    public function invoice() {

        return $this->belongsTo('App\Invoice');

    }
}
