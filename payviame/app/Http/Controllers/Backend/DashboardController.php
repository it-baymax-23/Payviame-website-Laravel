<?php

namespace App\Http\Controllers\Backend;

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
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);
        
        $userCount = User::whereSuper_admin(0)->count();
        $currencyCount = Currency::count();
        $quoteCount = Quote::count();
        $invoiceCount = Invoice::count();

        return view('admin.dashboard',compact('user','userCount','currencyCount','quoteCount','invoiceCount'));    
    }

    public function changeLang($profileID, $lang)
    {
        $profile = Profile::find($profileID);
        $profile->lang = $lang;
        $profile->save();
        return redirect()->back()->with('successMsg', __('Language Change Successfully!'));
    }
}
