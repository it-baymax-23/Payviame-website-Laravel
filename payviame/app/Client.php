<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $fillable = [
        'account_id',
        'user_id',
        'business_name',
        'contact_name',
        'email_address',
        'address_detail',
        'currency_id',
        'hourly_rate',
        'invoice_language',
        'invoice_numbering',
        'invoice_threshold',
        'monogram_color',
        'monogram_name',
        'client_logo',

    ];

    public function user(){

        return $this->belongsTo('App\User');

    }

    public function quotes() {

        return $this->hasMany('App\Quote');

    }

    public function invoices() {

        return $this->hasMany('App\Invoice');

    }

    public function currency() {
        return $this->belongsTo('App\Currency');
    }
}
