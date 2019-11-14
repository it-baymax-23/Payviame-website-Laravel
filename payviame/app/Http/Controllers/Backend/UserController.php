<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Profile;
use App\Client;
use App\Role;
use App\Membership;
use App\Currency;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
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

        $users = User::whereSuper_admin(0)->get();
        // $users = User::oldest()->paginate(10);

        return view('admin.user.index',compact('user','users'));
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

        $roles = Role::all();
        $memberships = Membership::all();

        return view('admin.user.create',compact('user','memberships','roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm-password' => 'required|same:password'
        ]);

        // var_dump($request->role);exit();

        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'active' => $request->active,
        ]);

        $user->role_id = $request->role;
        $user->save();


        if ($request->membership != 0) {
            $user->membership_id = $request->membership;
            $user->save();
        }

        Profile::create([

            'user_id'       => $user->id,
            
        ]);

        return redirect()->route('admin.user.index')->with('successMsg','User Successfully Saved');
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

        $currentUser = User::find($id);
        $memberships = Membership::all();
        return view('admin.user.edit',compact('user','currentUser','memberships'));
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
        $user = User::find($id);

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->active = $request->active;
        $user->role_id = $request->role;
        $user->save();

        if (isset($request->password)) {

            $this->validate($request,[
                'password' => 'required|min:6',
                'confirm-password' => 'required|same:password'
            ]);

            $user->password = Hash::make($request->password);

            $user->save();

        }

        if ($request->membership != 0) {
            $user->membership_id = $request->membership;
            $user->save();
        } else {
            $user->membership_id = null;
            $user->save();
        }

        return redirect()->route('admin.user.index')->with('successMsg','User Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        // if (file_exists('uploads/user/'.$user->image))
        // {
        //     unlink('uploads/user/'.$user->avarta);
        // }
        $user->delete();
        return redirect()->back()->with('successMsg','User Successfully Deleted');
    }
}
