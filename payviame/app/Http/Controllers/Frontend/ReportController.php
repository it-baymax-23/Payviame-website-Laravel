<?php

namespace App\Http\Controllers\Frontend;

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
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
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
    public function index(Request $request)
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        $account_id = Team::whereUser_id($user->id)->first()->account_id;

        $currencyID = Input::get('currency_id');
        if (!isset($currencyID)) {
            $current_currencyID = 0;
            $currencyID = $user->profile->currency_id;
        } else {
            $current_currencyID = $currencyID;
        }

        $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->get();
        $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->get();
        $current_currency = Currency::find($currencyID);

        $currencies = Currency::all();


        $draft_total_sum = 0;
        $sent_total_sum = 0;
        $accepted_total_sum = 0;
        $declined_total_sum = 0;
        $total_quote_sum = 0;

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

        $total_quote_sum = $draft_total_sum + $sent_total_sum + $accepted_total_sum + $declined_total_sum;

        $paid = 0;
        $total_invoice_sum = 0;
        $overdue = 0;
        $today = date('Y-m-d');

        foreach($invoices as $invoice)
        {
            $paid += round(Record::whereInvoice_id($invoice->id)->select('pay_value')->sum('pay_value'), 2);
            $total_invoice_sum += round($invoice->sum_total, 2);

            $payment_due = date_diff(date_create($invoice->payment_due), date_create($today));
            $diff = $payment_due->format('%R%a');
            if ($diff >  0) {
                $overdue += round(($invoice->sum_total - Record::whereInvoice_id($invoice->id)->select('pay_value')->sum('pay_value')), 2);
            }
        }

        $owing = $total_invoice_sum  - $paid;




        return view('report.index',compact('user','quotes','invoices','current_currency','currencies','current_currencyID','draft_total_sum','sent_total_sum','accepted_total_sum','declined_total_sum','total_quote_sum','paid','owing','overdue','total_invoice_sum'));
    }

    public function membership()
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        if ($user->role_id == 1) {
            return view('report.membership',compact('user'));
        } else {
            return '/teams';
        }
    }

    public function changeLang($profileID, $lang)
    {
        $profile = Profile::find($profileID);
        $profile->lang = $lang;
        $profile->save();
        // return redirect()->back()->with('successMsg', __('Language Change Successfully!'));
        return redirect()->back();
    }
}
