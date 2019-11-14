<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    //
    // protected $jsonable = ['quote_description',];

    protected $fillable = [
        'client_id',
        'account_id',
        'currency_id',
        'recipient_name',
        'recipient_address',
        'recipient_description',
        'quote_description',
        'sum_total',
        'sub_total',
        'sum_tax1',
        'sum_tax2',
        'date_issued',
        'accepted_at',
        'declined_at',
        'status',
        'attach_pdf'
    ];

    public function client() {

        return $this->belongsTo('App\Client');

    }

    public function account() {

        return $this->belongsTo('App\Account');

    }

    public function currency() {

        return $this->belongsTo('App\Currency');
        
    }
}
