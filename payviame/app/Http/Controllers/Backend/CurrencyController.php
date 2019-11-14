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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        $currencies = Currency::all();
        // $users = User::oldest()->paginate(10);

        return view('admin.currency.index',compact('user','currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        return view('admin.currency.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'currency_code' => 'required',
            'currency_symbol' => 'required',
            // 'currency_rate' => 'required',
            'currency_description' => 'required',
        ]);

        Currency::create([

            'currency_code' => $request->currency_code,
            'currency_symbol' => $request->currency_symbol,
            // 'currency_rate' => $request->currency_rate,
            'currency_description' => $request->currency_description,
        ]);

        return redirect()->route('admin.currency.index')->with('successMsg','Currency Successfully Saved');
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
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        $currency = Currency::find($id);
        return view('admin.currency.edit',compact('user','currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $currency = Currency::find($id);

        $this->validate($request,[
            'currency_code' => 'required',
            'currency_symbol' => 'required',
            'currency_description' => 'required',
            // 'currency_rate' => 'required',
        ]);

        $currency->currency_code = $request->currency_code;
        $currency->currency_symbol = $request->currency_symbol;
        $currency->currency_description = $request->currency_description;
        // $currency->currency_rate = $request->currency_rate;
        $currency->save();

        return redirect()->route('admin.currency.index')->with('successMsg','Currency Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency = Currency::find($id);
        $currency->delete();
        return redirect()->back()->with('successMsg','Currency Successfully Deleted');
    }
}
