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
use App\Notifications\UserInviteNotify;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class TeamController extends Controller
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

        $teams = Team::whereAccount_id($account_id)->oldest()->get();

        return view('team.index',compact('user','teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->role_id == 3) {
            return redirect()->back()->with('error', __('You don\'t have permission!'));
        } else {
            $currentLang = $user->profile->lang;
            \App::setLocale($currentLang);

            $account_id = Team::whereUser_id($user->id)->first()->account_id;
            $membership_id = Account::find($account_id)->user->membership_id;

            if (!isset($membership_id)) {
                return redirect()->route('report.membership')->with('error',__('You have to upgrade membership'));
            } else {
                if (Account::find($account_id)->user->active == 0) {
                    return redirect()->back()->with('error',__('Your account is Not Activate'));
                } else {
                    if ($membership_id == 1) {
                        return redirect()->back()->with('error',__('You have to upgrade membership'));
                    } elseif ($membership_id == 2) {
                        $account_id = Team::whereUser_id($user->id)->first()->account_id;

                        $num_team_members = count(Team::whereAccount_id($account_id)->get());
                        
                        $limit = Membership::find($membership_id);
                        if ($num_team_members >= $limit->total_user) {
                            return redirect()->back()->with('error','You have to upgrade membership');
                        } else {
                            return view('team.create',compact('user'));
                        }
                    } elseif ($membership_id == 3) {
                        $account_id = Team::whereUser_id($user->id)->first()->account_id;

                        $num_team_members = count(Team::whereAccount_id($account_id)->get());
                        
                        $limit = Membership::find($membership_id);
                        if ($num_team_members >= $limit->total_user) {
                            return redirect()->back()->with('error','You have to upgrade membership');
                        } else {
                            return view('team.create',compact('user'));
                        }
                    } elseif ($user->membership_id == 4) {
                        $account_id = Team::whereUser_id($user->id)->first()->account_id;

                        $num_team_members = count(Team::whereAccount_id($account_id)->get());
                        
                        $limit = Membership::find($membership_id);
                        if ($num_team_members >= $limit->total_user) {
                            return redirect()->back()->with('error','You have to upgrade membership');
                        } else {
                            return view('team.create',compact('user'));
                        }
                    } elseif ($user->membership_id == 5) {
                        return view('team.create',compact('user'));
                    }
                }
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        $password = "payviame12345";

        $invited_user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),

        ]);

        $invited_user->role_id = $request->role;
        $invited_user->save();

        Profile::create([

            'user_id'       => $invited_user->id,
            
        ]);

        $account_id = Team::whereUser_id($user->id)->first()->account_id;

        $team = Team::create([
            'account_id'    => $account_id,
            'user_id'       => $invited_user->id,
        ]);

        $invited_user->team_id = $team->id;
        $invited_user->save();

        $invited_user->notify(new UserInviteNotify($invited_user, $user));

        return redirect()->route('team.index')->with('success',__('Team member Successfully Saved'));
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
    public function update(Request $request, $id)
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

    public function changePermission($userID, $role_id)
    {
        $user = Auth::user();
        if ($user->role_id != 1) {
            return redirect()->back()->with('error', __('You don\'t have sufficient permission to edit permission!'));
        } else {
            $edit_user = User::find($userID);
            $edit_user->role_id = $role_id;
            $edit_user->save();
            return redirect()->back()->with('success', __('Permission Changed Successfully!'));
        }
    }
}
