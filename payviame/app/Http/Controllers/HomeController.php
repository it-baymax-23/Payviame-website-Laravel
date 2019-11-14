<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
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
        if (Auth::guest()) {
            return view('index');
        } else {
            $user = Auth::user();
            $currentLang = $user->profile->lang;
            \App::setLocale($currentLang);
            return view('index',compact('user'));
        }
    }

    public function pricing()
    {
        if (Auth::guest()) {
            return view('pricing');
        } else {
            $user = Auth::user();
            $currentLang = $user->profile->lang;
            \App::setLocale($currentLang);
            return view('pricing',compact('user'));
        }
    }
}
