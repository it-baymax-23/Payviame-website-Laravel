<?php

namespace App\Http\Controllers\Frontend;

use Barry_PDF;
use TC_PDF;
use M_PDF;
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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Elibyy\TCPDF\Facades\TCPDF;

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
    public function index(Request $request)
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        $account_id = Team::whereUser_id($user->id)->first()->account_id;

        $currencyID = Input::get('currency_id');
        $clientID = Input::get('client_id');
        $start = Input::get('start');
        $end = Input::get('end');
        $status = Input::get('status');
        $by = Input::get('by');
        $range = Input::get('range');

        if (!isset($currencyID)) {
            $current_currencyID = 0;
            $currencyID = $user->profile->currency_id;
        } else {
            $current_currencyID = $currencyID;
        }
        
        if (!isset($clientID) || $clientID == 0)
        {
            if (!isset($status) && !isset($by) && !isset($range)) {
                $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->get();
            } else {
                if ($status == 'current') {
                    if ($by == 'issued_at') {
                        if ($range == 'all-time') {
                            $start = date('Y-m-01');
                            $end = date('Y-m-t');
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereBetween('date_issued', [$start, $end])->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereBetween('date_issued', [$start, $end])->get();
                        }
                    } elseif ($by == 'accepted_at') {
                        if ($range == 'all-time') {
                            $start = date('Y-m-01');
                            $end = date('Y-m-t');
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereBetween('accepted_at', [$start, $end])->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereBetween('accepted_at', [$start, $end])->get();
                        }
                    } elseif ($by == 'declined_at') {
                        if ($range == 'all-time') {
                            $start = date('Y-m-01');
                            $end = date('Y-m-t');
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereBetween('declined_at', [$start, $end])->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereBetween('declined_at', [$start, $end])->get();
                        }
                    }
                } elseif ($status == 'all') {
                    if ($by == 'issued_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereBetween('date_issued', [$start, $end])->get();
                        }
                    } elseif ($by == 'accepted_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(2)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereBetween('accepted_at', [$start, $end])->get();
                        }
                    } elseif ($by == 'declined_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(3)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereBetween('declined_at', [$start, $end])->get();
                        }
                    }
                } elseif ($status == 'accepted') {
                    if ($by == 'issued_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(2)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(2)->whereBetween('date_issued', [$start, $end])->get();
                        }
                    } elseif ($by == 'accepted_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(2)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(2)->whereBetween('accepted_at', [$start, $end])->get();
                        }
                    } elseif ($by == 'declined_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(2)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(2)->whereBetween('declined_at', [$start, $end])->get();
                        }
                    }
                } elseif ($status == 'declined') {
                    if ($by == 'issued_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(3)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(3)->whereBetween('date_issued', [$start, $end])->get();
                        }
                    } elseif ($by == 'accepted_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(3)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(3)->whereBetween('accepted_at', [$start, $end])->get();
                        }
                    } elseif ($by == 'declined_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(3)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(3)->whereBetween('declined_at', [$start, $end])->get();
                        }
                    }
                }
            }
        } else {
            if (!isset($status) && !isset($by) && !isset($range)) {
                $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->get();
            } else {
                if ($status == 'current') {
                    if ($by == 'issued_at') {
                        if ($range == 'all-time') {
                            $start = date('Y-m-01');
                            $end = date('Y-m-t');
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereBetween('date_issued', [$start, $end])->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereBetween('date_issued', [$start, $end])->get();
                        }
                    } elseif ($by == 'accepted_at') {
                        if ($range == 'all-time') {
                            $start = date('Y-m-01');
                            $end = date('Y-m-t');
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereBetween('accepted_at', [$start, $end])->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereBetween('accepted_at', [$start, $end])->get();
                        }
                    } elseif ($by == 'declined_at') {
                        if ($range == 'all-time') {
                            $start = date('Y-m-01');
                            $end = date('Y-m-t');
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereBetween('declined_at', [$start, $end])->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereBetween('declined_at', [$start, $end])->get();
                        }
                    }
                } elseif ($status == 'all') {
                    if ($by == 'issued_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereBetween('date_issued', [$start, $end])->get();
                        }
                    } elseif ($by == 'accepted_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereBetween('accepted_at', [$start, $end])->get();
                        }
                    } elseif ($by == 'declined_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereBetween('declined_at', [$start, $end])->get();
                        }
                    }
                } elseif ($status == 'accepted') {
                    if ($by == 'issued_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(2)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(2)->whereBetween('date_issued', [$start, $end])->get();
                        }
                    } elseif ($by == 'accepted_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(2)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(2)->whereBetween('accepted_at', [$start, $end])->get();
                        }
                    } elseif ($by == 'declined_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(2)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(2)->whereBetween('declined_at', [$start, $end])->get();
                        }
                    }
                } elseif ($status == 'declined') {
                    if ($by == 'issued_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(3)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(3)->whereBetween('date_issued', [$start, $end])->get();
                        }
                    } elseif ($by == 'accepted_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(3)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(3)->whereBetween('accepted_at', [$start, $end])->get();
                        }
                    } elseif ($by == 'declined_at') {
                        if ($range == 'all-time') {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(3)->get();
                        } else {
                            $quotes = Quote::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(3)->whereBetween('declined_at', [$start, $end])->get();
                        }
                    }
                }
            }
        }

        $clients = Client::whereAccount_id($account_id)->get();

        $currencies = Currency::all();
        if (!isset($clientID))
            $clientID = 0;
        if (!isset($range))
            $range = 'all-time';
        $current_currency = Currency::find($currencyID);

        // var_dump($currency->currency_code);exit();

        // $draft_total_sum = 0;
        // $sent_total_sum = 0;
        // $accepted_total_sum = 0;
        // $declined_total_sum = 0;
        // $total_sum = 0;

        // foreach($quotes as $quote)
        // {
        //     if ($quote->status == 0) {
        //         $draft_total_sum += round($quote->sum_total * (1 / $quote->currency->currency_rate), 2);
        //     } elseif ($quote->status == 1) {
        //         $sent_total_sum += round($quote->sum_total * (1 / $quote->currency->currency_rate), 2);
        //     } elseif ($quote->status == 2) {
        //         $accepted_total_sum += round($quote->sum_total * (1 / $quote->currency->currency_rate), 2);
        //     } else {
        //         $declined_total_sum += round($quote->sum_total * (1 / $quote->currency->currency_rate), 2);
        //     }
        // }

        // $total_sum = $draft_total_sum + $sent_total_sum + $accepted_total_sum + $declined_total_sum;

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

        return view('quote.index',compact('user','quotes','clients','currencies','clientID','current_currencyID','current_currency','status','range','by','start','end','draft_total_sum','sent_total_sum','accepted_total_sum','declined_total_sum','total_sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = Auth::user();

        $account_id = Team::whereUser_id($user->id)->first()->account_id;
        
        $client = Client::find($id);
        
        $quote = Quote::create([
            'client_id' => $id,
            'account_id' => $account_id,
            'currency_id' => $user->profile->currency_id,
            'recipient_name' => $client->contact_name,
            'recipient_address' => $client->address_detail,
            'date_issued' => date('Y-m-d'),
            
        ]);

        return redirect()->route('quote.edit',$quote->id)->with('success',__('Drafted New Quote ' . $quote->id . ' for ' . $client->business_name));

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
            'business_name' => 'required|exists:clients'
        ]);

        $user = Auth::user();

        $account_id = Team::whereUser_id($user->id)->first()->account_id;
        
        $client = Client::whereBusiness_name($request->business_name)->get();
        $quote = Quote::create([
            'client_id' => $client[0]->id,
            'account_id' => $account_id,
            'currency_id' => $user->profile->currency_id,
            'recipient_name' => $client[0]->contact_name,
            'recipient_address' => $client[0]->address_detail,
            'date_issued' => date('Y-m-d'),
        ]);

        return redirect()->route('quote.edit',$quote->id)->with('success',__('Drafted New Quote ' . $quote->id . ' for ' . $request->business_name));
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

        $quote = Quote::find($id);

        $taxes = Tax::whereUser_id($quote->account->user->id)->get();

        $quote_descriptions = json_decode($quote->quote_description);

        return view('quote.show',compact('user','quote','taxes','quote_descriptions'));
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

        $quote = Quote::find($id);

        $inventories = Inventory::whereUser_id($quote->account->user->id)->get();

        $taxes = Tax::whereUser_id($quote->account->user->id)->get();

        $quote_descriptions = json_decode($quote->quote_description);

        return view('quote.edit',compact('user', 'quote', 'inventories', 'taxes', 'quote_descriptions'));
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
        $user = Auth::user();

        $quote = Quote::find($request->id);

        $quote->recipient_name = $request->recipient_name;
        $quote->recipient_address = $request->recipient_address;
        $quote->date_issued = $request->date_issued;
        $quote->recipient_description = $request->recipient_description;
        $quote->quote_description = json_encode($request->quote_description);
        $quote->sum_total = $request->sum_total;
        $quote->sub_total = $request->sub_total;
        $quote->sum_tax1 = $request->sum_tax1;
        $quote->sum_tax2 = $request->sum_tax2;
        $quote->quote_footer = $request->quote_footer;
        $quote->save();

        return  response()->json(['success'=>'Your changed to ' . $quote->id . 'have been saved']);
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
            $quote = Quote::find($id);
            if (file_exists($quote->attach_pdf))
            {
                unlink($quote->attach_pdf);
            }
            $quote->delete();
            return redirect()->route('quote.index')->with('success',__('Quote Successfully Deleted'));
        }
    }

    public function generatePDF(Request $request)
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        $quote = Quote::find($request->id);

        $taxes = Tax::whereUser_id($quote->account->user->id)->get();

        $quote_descriptions = json_decode($quote->quote_description);

        $pdf_name = $quote->recipient_name . '_quote_' . $quote->id . '.pdf';

        if (!file_exists('uploads/attach_files'))
        {
            mkdir('uploads/attach_files', 0777 , true);
        }

        $quote->attach_pdf = $pdf_name;
        $quote->save();

        // $pdf = Barry_PDF::loadView('quote.pdf_preview', compact('user','quote','taxes','quote_descriptions'));

        // $pdf->save('uploads/attach_files/' . $pdf_name);

        $view = \View::make('quote.pdf_make', compact('user','quote','taxes','quote_descriptions'));
        $html_content = $view->render();

        TC_PDF::AddPage();
        TC_PDF::writeHTML($html_content, true, false, true, false, '');
 
        TC_PDF::Output(public_path('uploads/attach_files/' . $pdf_name), 'F');

        return response()->json(['success'=>'PDF Successfully generated.']);
    }

    public function downloadPDF($id)
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        $quote = Quote::find($id);

        $file= public_path(). '/uploads/attach_files/'.$quote->attach_pdf;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download($file, $quote->attach_pdf, $headers);
    }

    public function print_preview($id)
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        $quote = Quote::find($id);

        $taxes = Tax::whereUser_id($quote->account->user->id)->get();

        $quote_descriptions = json_decode($quote->quote_description);
        
        return view('quote.pdf_preview', compact('user','quote','taxes','quote_descriptions'));
    }

    public function duplicate_quote($id)
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        $quote = Quote::find($id);

        $duplicate_quote = Quote::create([
            'client_id' => $quote->client_id,
            'account_id' => $quote->account_id,
            'currency_id' => $quote->currency_id,
            'recipient_name' => $quote->recipient_name,
            'recipient_address' => $quote->recipient_address,
            'date_issued' => $quote->date_issued,
            'recipient_description' => $quote->recipient_description,
            'quote_description' => $quote->quote_description,
            'sum_total' => $quote->sum_total,
            'sub_total' => $quote->sub_total,
            'sum_tax1' => $quote->sum_tax1,
            'sum_tax2' => $quote->sum_tax2,
            'quote_footer' => $quote->quote_footer
        ]);
        
        return redirect()->route('quote.edit',$duplicate_quote->id)->with('success',__('Duplicated Quote ' . $duplicate_quote->id . ' for ' . $quote->client->business_name));
    }

    public function send(Request $request, $id)
    {
        $user = Auth::user();
        $quote = Quote::find($id);
        
        if ($request->attachPDF) {
            $data = array(
                'email' => $request->toClient,
                'subject' => $request->subject,
                'from' => $quote->account->user->email,
                'bodyMessage' => $request->mailContent,
                'file' => $quote->attach_pdf
            );
            \Mail::to($data['email'])->send(new ClientSendQuote($data));
        } else {
            $data = array(
                'email' => $request->toClient,
                'subject' => $request->subject,
                'bodyMessage' => $request->mailContent,
                'from' => $quote->account->user->email,
                'bodyMessage' => $request->mailContent,
                'file' => Null
            );
            \Mail::to($data['email'])->send(new ClientSendQuote($data));
        }
        $quote->status = 1;
        $quote->save();

        return redirect()->back()->with('success',__('Quote Successfully Sended.'));

    }

    public function status_update($id, $status)
    {
        $quote = Quote::find($id);
        $quote->status = $status;
        if ($status == 2) {
            $quote->accepted_at = date('Y-m-d');
        } elseif ($status == 3) {
            $quote->declined_at = date('Y-m-d');
        }
        $quote->save();
        return redirect()->back()->with('success', __('Quote Successfully Updated.'));
    }
}
