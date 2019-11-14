<?php

namespace App\Http\Controllers\Backend;

use PDF;
use Mail;
use File;
use App\User;
use App\Profile;
use App\Inventory;
use App\Tax;
use App\Client;
use App\Quote;
use App\Invoice;
use App\Record;
use App\Account;
use App\Team;
use App\Membership;
use App\Currency;
use App\Notifications\ClientSendQuote;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class QuoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($accountID = Null, $currencyID = 1)
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);
        
        if (!$accountID || $accountID == 0)
        {
            if (!$currencyID || $currencyID == 0)
            {
                $quotes = Quote::all();
            } else {
                $quotes = Quote::whereCurrency_id($currencyID)->get();
            }
        } else {
            if (!$currencyID || $currencyID == 0)
            {
                $quotes = Quote::whereAccount_id($accountID)->get();
            } else {
                $quotes = Quote::whereAccount_id($accountID)->whereCurrency_id($currencyID)->get();
            }
        }

        $accounts = Account::where('user_id', '!=', 1)->get();
        $quoteCount = count($quotes);

        $currencies = Currency::all();
        $current_currency = Currency::find($currencyID);

        $draft_total_sum = 0;
        $sent_total_sum = 0;
        $accepted_total_sum = 0;
        $declined_total_sum = 0;
        $total_sum = 0;

        foreach($quotes as $quote)
        {
            if ($quote->status == 0) {
                $draft_total_sum += round($quote->sum_total, 2);
            } elseif ($quote->status == 1) {
                $sent_total_sum += round($quote->sum_total, 2);
            } elseif ($quote->status == 2) {
                $accepted_total_sum += round($quote->sum_total, 2);
            } else {
                $declined_total_sum += round($quote->sum_total, 2);
            }
        }

        $total_sum = $draft_total_sum + $sent_total_sum + $accepted_total_sum + $declined_total_sum;

        return view('admin.quote',compact('user','quotes','accounts','quoteCount','currencies','current_currency','accountID','draft_total_sum','sent_total_sum','accepted_total_sum','declined_total_sum','total_sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
