<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = [
        'user_id',
        'currency_id',
        'business_name',
        'contact_name',
        'company_number',
        'vat_number',
        'business_address',
        'payment_term',
        'invoice_footer',
        'quote_footer',
        'user_avatar',
        'company_logo',
        'lang',

    ];

    public function user() {

        return $this->belongsTo('App\User');

    }

    public function currency() {

        return $this->belongsTo('App\Currency');
        
    }

    public function languages() {
        $dir    = base_path().'/resources/lang/';
        
        $glob   =  glob($dir."*",GLOB_ONLYDIR);
        $arrLang =  array_map(function($value) use($dir) { return str_replace($dir, '', $value); }, $glob);
        $arrLang =  array_map(function($value) use($dir) { return preg_replace('/[0-9]+/', '', $value); }, $arrLang);
        $arrLang = array_filter($arrLang);
        return $arrLang;
    }
}
