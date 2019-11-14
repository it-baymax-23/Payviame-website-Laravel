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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
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
    public function profile_index($id)
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        $profile = Profile::find($id);

        return view('setting.profile',compact('user','profile'));
    }

    public function profile_update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'user_avatar' => 'mimes:jpeg,jpg,bmp,png',
        ]);

        $profile = Profile::find($id);

        $user_avatar = $request->file('user_avatar');
        
        if (isset($user_avatar))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate .'-'. uniqid() .'.'. $user_avatar->getClientOriginalExtension();
            if (!file_exists('uploads/user_avatar'))
            {
                mkdir('uploads/user_avatar', 0777 , true);
            }
            $user_avatar->move('uploads/user_avatar',$imagename);
            $imagename = 'uploads/user_avatar/' . $imagename;
        }else {
            $imagename = $profile->user_avatar;
        }

        $profile->user_avatar = $imagename;
        $profile->save();

        $user = User::find($profile->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('success',__('Profile Successfully Updated'));
    }

    public function password_index()
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;

        return view('setting.password',compact('user'));
    }

    public function password_update(Request $request)
    {
        $this->validate($request,[
            'password' => 'required|min:6',
            'confirm-password' => 'required|same:password'
        ]);

        $user = Auth::user();

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->back()->with('success',__('Password Successfully Changed'));
    }

    public function business_detail()
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        return view('setting.business',compact('user'));
    }

    public function business_detail_update(Request $request, $id)
    {

        $profile = Profile::find($id);
        $profile->business_name = $request->business_name;
        $profile->contact_name = $request->contact_name;
        $profile->company_number = $request->company_number;
        $profile->vat_number = $request->vat_number;
        $profile->business_address = $request->business_address;
        $profile->save();
        return redirect()->back()->with('success',__('Business Detail Successfully Updated'));
    }

    public function default_index()
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        $currencies = Currency::all();
        $taxes = Tax::whereUser_id($user->id)->get();
        return view('setting.default',compact('user','currencies','taxes'));
    }

    public function defaul_update(Request $request, $id)
    {
        // $this->validate($request,[
        //     'currency_id' => 'required'
        //     'payment_term' => 'required',
        //     'invoice_footer' => 'required',
        //     'quote_footer' => 'required',
        //     'company_logo' => 'mimes:jpeg,jpg,bmp,png',
        // ]);

        $profile = Profile::find($id);

        $company_logo = $request->file('company_logo');
        
        if (isset($company_logo))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate .'-'. uniqid() .'.'. $company_logo->getClientOriginalExtension();
            if (!file_exists('uploads/company_logo'))
            {
                mkdir('uploads/company_logo', 0777 , true);
            }
            $company_logo->move('uploads/company_logo',$imagename);
            $imagename = 'uploads/company_logo/' . $imagename;
        }else {
            $imagename = $profile->company_logo;
        }
        $profile->currency_id = $request->currency_id;
        $profile->payment_term = $request->payment_term;
        $profile->invoice_footer = $request->invoice_footer;
        $profile->quote_footer = $request->quote_footer;
        $profile->company_logo = $imagename;
        $profile->save();
        return redirect()->back()->with('success',__('Detail Successfully Updated'));
    }

    public function tax_store(Request $request)
    {
        $user = Auth::user();

        $tax = Tax::create([
            'user_id' => $user->id,
            'tax_description' => $request->tax_description,
            'tax_percentage' => $request->tax_percentage,
        ]);

        return response()->json(['success'=>'Default Tax Successfully Saved']);
    }

    public function tax_update(Request $request)
    {
        $user = Auth::user();

        $tax = Tax::find($request->id);

        $tax->tax_description = $request->tax_description;
        $tax->tax_percentage = $request->tax_percentage;
        $tax->save();
        return response()->json(['success'=>'Default Tax Successfully Updated']);
    }

    public function tax_destroy($id)
    {
        $user = Auth::user();
        if ($user->role_id != 1) {
            return redirect()->back()->with('error', __('You don\'t have permission!'));
        } else {
            Tax::find($id)->delete();
            return redirect()->back()->with('success', __('Default Tax Successfully Deleted!'));
        }
    }

    public function inventory_index()
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        $inventories = Inventory::whereUser_id($user->id)->get();
        return view('setting.inventory',compact('user','inventories'));
    }

    public function inventory_store(Request $request)
    {
        $user = Auth::user();

        $inventory = Inventory::create([
            'user_id' => $user->id,
            'inventory_description' => $request->inventory_description,
            'inventory_price' => $request->inventory_price,
            
        ]);

        return response()->json(['success'=>'Inventory Successfully Saved']);
    }

    public function inventory_update(Request $request)
    {
        $user = Auth::user();

        $inventory = Inventory::find($request->id);

        $inventory->inventory_description = $request->inventory_description;
        $inventory->inventory_price = $request->inventory_price;
        $inventory->save();
        return response()->json(['success'=>'Inventory Successfully Updated']);
    }

    public function inventory_destroy($id)
    {
        $user = Auth::user();
        if ($user->role_id != 1) {
            return redirect()->back()->with('error', __('You don\'t have permission!'));
        } else {
            Inventory::find($id)->delete();
            return redirect()->back()->with('success', __('Inventory Successfully Deleted!'));
        }
    }

    public function changeLang($profileID, $lang)
    {
        $profile = Profile::find($profileID);
        $profile->lang = $lang;
        $profile->save();
        // return redirect()->back()->with('success', __('Language Change Successfully!'));
        return redirect()->back()->with('success', __('Language Change Successfully!'));
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->role_id != 1) {
            return redirect()->back()->with('error', __('You don\'t have permission!'));
        } else {
            $user_id = Profile::find($id)->user_id;
            
            if($user->id == $user_id) {
                User::find($user_id)->delete();
                Auth::logout();
                return redirect()->route('dashboard')->with('success',__('Account Successfully Closed'));
            } else {
                User::find($user_id)->delete();
                return redirect()->route('team.index')->with('success',__('Team member Successfully Deleted'));
            }
        }
    }

    public function performence_index()
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        $currencies = Currency::all();
        return view('setting.performence',compact('user','currencies'));
    }

    public function performence_update(Request $request, $id)
    {
        $profile = Profile::find($id);
        $profile->currency_id = $request->currency_id;
        $profile->save();
        return redirect()->back()->with('success',__('Performence Successfully Updated'));
    }
}
