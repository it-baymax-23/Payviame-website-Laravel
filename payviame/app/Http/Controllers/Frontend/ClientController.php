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
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
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
    public function index()
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);
        
        $account_id = Team::whereUser_id($user->id)->first()->account_id;
        $clients = Client::whereAccount_id($account_id)->whereClient_status(0)->get();
        return view('client.index',compact('user','clients'));
    }

    public function archived()
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);
        
        $account_id = Team::whereUser_id($user->id)->first()->account_id;
        $clients = Client::whereAccount_id($account_id)->whereClient_status(1)->get();
        return view('client.archived',compact('user','clients'));
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
    public function store(Request $request, $go_edit)
    {
        $this->validate($request,[
            'business_name' => 'required'
        ]);

        $monogram_name = substr($request->business_name, 0, 2);

        $user = Auth::user();

        $account_id = Team::whereUser_id($user->id)->first()->account_id;
        $membership_id = Account::find($account_id)->user->membership_id;

        if (!isset($membership_id)) {
            return redirect()->route('report.membership')->with('error',__('You have to upgrade membership'));
        } else {
            if (Account::find($account_id)->user->active == 0) {
                return redirect()->back()->with('error',__('Your account is Not Activate'));
            } else {
                if ($membership_id == 1) {
                    $num_clients = count(Client::whereAccount_id($account_id)->get());
                    $limit = Membership::find($membership_id);
                    if ($num_clients >= $limit->total_client) {
                        return redirect()->back()->with('error',__('You have to upgrade membership'));
                    } else {
                        $client = new Client();
                        $client->user_id = $user->id;
                        $client->account_id = $account_id;
                        $client->business_name = $request->business_name;
                        $client->monogram_name = $monogram_name;
                        $client->save();
                        if ($go_edit == 'store') {
                            return redirect()->route('client.index')->with('success',__('Client Successfully Saved'));
                        } else {
                            return redirect()->route('client.edit',$client->id);
                        }
                    }
                } elseif ($membership_id == 2) {
                    $num_clients = count(Client::whereAccount_id($account_id)->get());
                    $limit = Membership::find($membership_id);
                    if ($num_clients >= $limit->total_client) {
                        return redirect()->back()->with('error',__('You have to upgrade membership'));
                    } else {
                        $client = new Client();
                        $client->user_id = $user->id;
                        $client->account_id = $account_id;
                        $client->business_name = $request->business_name;
                        $client->monogram_name = $monogram_name;
                        $client->save();
                        if ($go_edit == 'store') {
                            return redirect()->route('client.index')->with('success',__('Client Successfully Saved'));
                        } else {
                            return redirect()->route('client.edit',$client->id);
                        }
                    }
                } elseif ($user->membership_id == 3) {
                    $num_clients = count(Client::whereAccount_id($account_id)->get());
                    $limit = Membership::find($membership_id);
                    if ($num_clients >= $limit->total_client) {
                        return redirect()->back()->with('error',__('You have to upgrade membership'));
                    } else {
                        $client = new Client();
                        $client->user_id = $user->id;
                        $client->account_id = $account_id;
                        $client->business_name = $request->business_name;
                        $client->monogram_name = $monogram_name;
                        $client->save();
                        if ($go_edit == 'store') {
                            return redirect()->route('client.index')->with('success',__('Client Successfully Saved'));
                        } else {
                            return redirect()->route('client.edit',$client->id);
                        }
                    }
                } elseif ($user->membership_id == 4) {
                    $num_clients = count(Client::whereAccount_id($account_id)->get());
                    $limit = Membership::find($membership_id);
                    if ($num_clients >= $limit->total_client) {
                        return redirect()->back()->with('error',__('You have to upgrade membership'));
                    } else {
                        $client = new Client();
                        $client->user_id = $user->id;
                        $client->account_id = $account_id;
                        $client->business_name = $request->business_name;
                        $client->monogram_name = $monogram_name;
                        $client->save();
                        if ($go_edit == 'store') {
                            return redirect()->route('client.index')->with('success',__('Client Successfully Saved'));
                        } else {
                            return redirect()->route('client.edit',$client->id);
                        }
                    }
                } elseif ($user->membership_id == 5) {
                    $client = new Client();
                    $client->user_id = $user->id;
                    $client->account_id = $account_id;
                    $client->business_name = $request->business_name;
                    $client->monogram_name = $monogram_name;
                    $client->save();
                    if ($go_edit == 'store') {
                        return redirect()->route('client.index')->with('success',__('Client Successfully Saved'));
                    } else {
                        return redirect()->route('client.edit',$client->id);
                    }
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);
        $client = Client::find($id);
        return view('client.show',compact('user','client'));
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
        $client = Client::find($id);

        $currencies = Currency::all();
        return view('client.edit',compact('user','client','currencies'));
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
        // $this->validate($request,[
        //     'business_name' => 'required',
        //     'email_address' => 'required|email',
        // ]);

        $user = Auth::user();
        $client = Client::find($id);

        $client->user_id = $user->id;
        $client->business_name = $request->business_name;
        $client->contact_name = $request->contact_name;
        $client->email_address = $request->email_address;
        $client->address_detail = $request->address_detail;
        $client->currency_id = $request->currency_id;

        if ($request->badge_type == 'monogram') {
            $client->monogram_name = $request->monogram_name;
            $client->monogram_color = $request->monogram_color;

        } else {
            $client_logo = $request->file('client_logo');
        
            if (isset($client_logo))
            {
                $currentDate = Carbon::now()->toDateString();
                $imagename = $currentDate .'-'. uniqid() .'.'. $client_logo->getClientOriginalExtension();
                if (!file_exists('uploads/client_logo'))
                {
                    mkdir('uploads/client_logo', 0777 , true);
                }
                $client_logo->move('uploads/client_logo',$imagename);
                $imagename = 'uploads/client_logo/' . $imagename;
            }else {
                $imagename = $client->client_logo;
            }

            $client->client_logo = $imagename;
        }
        $client->save();
        return redirect()->back()->with('success', __('Client Successfully Updated'));
        // return redirect()->back();
    }

    public function archived_update(Request $request, $id)
    {
        // $this->validate($request,[
        //     'business_name'=>'required'
        // ]);
        $user = Auth::user();
        $client = Client::find($id);
        $client->user_id = $user->id;
        $client->client_status = 1;
        $client->save();
        return redirect()->route('client.archived')->with('success',__('Client Successfully Archived'));
        // return redirect()->back();
    }

    public function unarchived_update(Request $request, $id)
    {
        // $this->validate($request,[
        //     'business_name'=>'required'
        // ]);
        $user = Auth::user();
        $client = Client::find($id);
        $client->user_id = $user->id;
        $client->client_status = 0;
        $client->save();
        return redirect()->route('client.index')->with('success',__('Client Successfully Unarchived'));
        // return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->role_id == 3) {
            return redirect()->back()->with('error', __('You don\'t have permission!'));
        } else {
            Client::find($id)->delete();
            return redirect()->route('client.index')->with('success',__('Client Successfully Deleted'));
        }
    }
}
