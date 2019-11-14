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
use App\Notifications\ClientSendInvoice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InvoiceController extends Controller
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
                $invoices = Invoice::all();
            } else {
                $invoices = Invoice::whereCurrency_id($currencyID)->get();
            }
        } else {
            if (!$currencyID || $currencyID == 0)
            {
                $invoices = Invoice::whereAccount_id($accountID)->get();
            } else {
                $invoices = Invoice::whereAccount_id($accountID)->whereCurrency_id($currencyID)->get();
            }
        }

        $accounts = Account::where('user_id', '!=', 1)->get();
        $invoiceCount = count($invoices);

        $currencies = Currency::all();
        $current_currency = Currency::find($currencyID);

        $paid = 0;
        $total_sum = 0;
        $overdue = 0;
        $today = date('Y-m-d');

        foreach($invoices as $invoice)
        {
            $paid += round(Record::whereInvoice_id($invoice->id)->select('pay_value')->sum('pay_value'), 2);
            $total_sum += round($invoice->sum_total, 2);

            $payment_due = date_diff(date_create($invoice->payment_due), date_create($today));
            $diff = $payment_due->format('%R%a');
            if ($diff >  0) {
                $overdue += round(($invoice->sum_total - Record::whereInvoice_id($invoice->id)->select('pay_value')->sum('pay_value')), 2);
            }
        }

        $owing = $total_sum  - $paid;

        return view('admin.invoice',compact('user','invoices','accounts','invoiceCount','currencies','current_currency','accountID','paid','owing','overdue','total_sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
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
