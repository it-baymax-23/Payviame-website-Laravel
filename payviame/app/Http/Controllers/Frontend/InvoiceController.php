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
use App\Notifications\ClientSendInvoice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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
                $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->get();
            } else {
                if ($status == 'all') {
                    if ($by == 'issued_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereBetween('date_issued', [$start, $end])->get();
                        }
                    } elseif ($by == 'due_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->where('payment_due', '<', date('Y-m-d'))->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->where('payment_due', '<', date('Y-m-d'))->whereBetween('payment_due', [$start, $end])->get();
                        }
                    } elseif ($by == 'paid_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(3)->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(3)->whereBetween('paid_at', [$start, $end])->get();
                        }
                    }
                } elseif ($status == 'overdue') {
                    if ($by == 'issued_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->where('payment_due', '<', date('Y-m-d'))->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->where('payment_due', '<', date('Y-m-d'))->whereBetween('date_issued', [$start, $end])->get();
                        }
                    } elseif ($by == 'due_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->where('payment_due', '<', date('Y-m-d'))->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->where('payment_due', '<', date('Y-m-d'))->whereBetween('payment_due', [$start, $end])->get();
                        }
                    } elseif ($by == 'paid_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->where('payment_due', '<', date('Y-m-d'))->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->where('payment_due', '<', date('Y-m-d'))->whereBetween('paid_at', [$start, $end])->get();
                        }
                    }
                } elseif ($status == 'unpaid') {
                    if ($by == 'issued_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->whereBetween('date_issued', [$start, $end])->get();
                        }
                    } elseif ($by == 'due_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->where('payment_due', '<', date('Y-m-d'))->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->where('payment_due', '<', date('Y-m-d'))->whereBetween('payment_due', [$start, $end])->get();
                        }
                    } elseif ($by == 'paid_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(3)->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(3)->whereBetween('paid_at', [$start, $end])->get();
                        }
                    }
                } elseif ($status == 'paid') {
                    if ($by == 'issued_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(3)->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(3)->whereBetween('date_issued', [$start, $end])->get();
                        }
                    } elseif ($by == 'due_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(3)->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(3)->whereBetween('payment_due', [$start, $end])->get();
                        }
                    } elseif ($by == 'paid_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(3)->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereCurrency_id($currencyID)->whereStatus(3)->whereBetween('paid_at', [$start, $end])->get();
                        }
                    }
                }
            }
        } else {
            if (!isset($status) && !isset($by) && !isset($range)) {
                $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->get();
            } else {
                if ($status == 'all') {
                    if ($by == 'issued_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereBetween('date_issued', [$start, $end])->get();
                        }
                    } elseif ($by == 'due_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereBetween('payment_due', [$start, $end])->get();
                        }
                    } elseif ($by == 'paid_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(3)->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(3)->whereBetween('paid_at', [$start, $end])->get();
                        }
                    }
                } elseif ($status == 'overdue') {
                    if ($by == 'issued_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->where('payment_due', '<', date('Y-m-d'))->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->where('payment_due', '<', date('Y-m-d'))->whereBetween('date_issued', [$start, $end])->get();
                        }
                    } elseif ($by == 'due_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->where('payment_due', '<', date('Y-m-d'))->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->where('payment_due', '<', date('Y-m-d'))->whereBetween('payment_due', [$start, $end])->get();
                        }
                    } elseif ($by == 'paid_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->where('payment_due', '<', date('Y-m-d'))->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->where('payment_due', '<', date('Y-m-d'))->whereBetween('paid_at', [$start, $end])->get();
                        }
                    }
                } elseif ($status == 'unpaid') {
                    if ($by == 'issued_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->whereBetween('date_issued', [$start, $end])->get();
                        }
                    } elseif ($by == 'due_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->whereBetween('payment_due', [$start, $end])->get();
                        }
                    } elseif ($by == 'paid_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(0,1,2)->whereBetween('paid_at', [$start, $end])->get();
                        }
                    }
                } elseif ($status == 'paid') {
                    if ($by == 'issued_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(3)->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(3)->whereBetween('date_issued', [$start, $end])->get();
                        }
                    } elseif ($by == 'due_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(3)->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(3)->whereBetween('payment_due', [$start, $end])->get();
                        }
                    } elseif ($by == 'paid_at') {
                        if ($range == 'all-time') {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(3)->get();
                        } else {
                            $invoices = Invoice::whereAccount_id($account_id)->whereClient_id($clientID)->whereCurrency_id($currencyID)->whereStatus(3)->whereBetween('paid_at', [$start, $end])->get();
                        }
                    }
                }
            }
        }

        $clients = Client::whereAccount_id($account_id)->get();

        $currencies = Currency::all();
        $current_currency = Currency::find($currencyID);
        if (!isset($clientID))
            $clientID = 0;
        if (!isset($range))
            $range = 'all-time';
        if (!isset($status))
            $status = 'all';

        // $paid = 0;
        // $total_sum = 0;
        // $overdue = 0;
        // $today = date('Y-m-d');

        // foreach($invoices as $invoice)
        // {
        //     $paid += round(Record::whereInvoice_id($invoice->id)->select('pay_value')->sum('pay_value') * (1 / $invoice->currency->currency_rate), 2);
        //     $total_sum += round($invoice->sum_total * (1 / $invoice->currency->currency_rate), 2);

        //     $payment_due = date_diff(date_create($invoice->payment_due), date_create($today));
        //     $diff = $payment_due->format('%R%a');
        //     if ($diff >  0) {
        //         $overdue += round(($invoice->sum_total - Record::whereInvoice_id($invoice->id)->select('pay_value')->sum('pay_value')) * (1 / $invoice->currency->currency_rate), 2);
        //     }
        // }

        // $owing = $total_sum  - $paid;

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

        return view('invoice.index',compact('user','invoices','clients','currencies','clientID','current_currencyID','current_currency','status','range','by','start','end','paid','owing','overdue','total_sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new($clientId)
    {
        $user = Auth::user();

        $account_id = Team::whereUser_id($user->id)->first()->account_id;
        $payment_term = Account::find($account_id)->user->profile->payment_term;
        
        $client = Client::find($clientId);
        
        $invoice = Invoice::create([
            'client_id' => $clientId,
            'account_id' => $account_id,
            'currency_id' => $user->profile->currency_id,
            'recipient_name' => $client->contact_name,
            'recipient_address' => $client->address_detail,
            'date_issued' => date('Y-m-d'),
            'payment_due' => date('Y-m-d', strtotime('+'.$payment_term.' days')),
            
        ]);

        return redirect()->route('invoice.edit',$invoice->id)->with('success',__('Drafted New Invoice ' . $invoice->id . ' for ' . $client->business_name));
    }

    public function create($clientId, $quoteID)
    {
        $user = Auth::user();

        $account_id = Team::whereUser_id($user->id)->first()->account_id;
        $payment_term = Account::find($account_id)->user->profile->payment_term;
        
        $client = Client::find($clientId);
        if (!isset($quoteID)) {
            $invoice = Invoice::create([
                'client_id' => $clientId,
                'account_id' => $account_id,
                'currency_id' => $user->profile->currency_id,
                'recipient_name' => $client->contact_name,
                'recipient_address' => $client->address_detail,
                'date_issued' => date('Y-m-d'),
                'payment_due' => date('Y-m-d', strtotime('+'.$payment_term.' days')),
                
            ]);
        } else {
            $quote = Quote::find($quoteID);
            $invoice = Invoice::create([
                'client_id' => $clientId,
                'account_id' => $account_id,
                'currency_id' => $user->profile->currency_id,
                'recipient_name' => $quote->recipient_name,
                'recipient_address' => $quote->recipient_address,
                'date_issued' => date('Y-m-d'),
                'payment_due' => date('Y-m-d', strtotime('+'.$payment_term.' days')),
                'recipient_description' => $quote->recipient_description,
                'invoice_description' => $quote->quote_description,
                'sum_total' => $quote->sum_total,
                'sub_total' => $quote->sub_total,
                'sum_tax1' => $quote->sum_tax1,
                'sum_tax2' => $quote->sum_tax2,
                'invoice_footer' => $quote->quote_footer,
            ]);
        }

        return redirect()->route('invoice.edit',$invoice->id)->with('success',__('Drafted New Invoice ' . $invoice->id . ' for ' . $client->business_name));
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
        $payment_term = Account::find($account_id)->user->profile->payment_term;
        
        $client = Client::whereBusiness_name($request->business_name)->get();
        $invoice = Invoice::create([
            'client_id' => $client[0]->id,
            'account_id' => $account_id,
            'currency_id' => $user->profile->currency_id,
            'recipient_name' => $client[0]->contact_name,
            'recipient_address' => $client[0]->address_detail,
            'date_issued' => date('Y-m-d'),
            'payment_due' => date('Y-m-d', strtotime('+'.$payment_term.' days')),
        ]);

        return redirect()->route('invoice.edit',$invoice->id)->with('success',__('Drafted New Invoice ' . $invoice->id . ' for ' . $request->business_name));
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

        $invoice = Invoice::find($id);

        $taxes = Tax::whereUser_id($invoice->account->user->id)->get();

        $invoice_descriptions = json_decode($invoice->invoice_description);

        $paid = Record::whereInvoice_id($id)->select('pay_value')->sum('pay_value');
        $owing = $invoice->sum_total - $paid;

        return view('invoice.show',compact('user','invoice','taxes','invoice_descriptions','paid','owing'));
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

        $invoice = Invoice::find($id);

        $inventories = Inventory::whereUser_id($invoice->account->user->id)->get();

        $taxes = Tax::whereUser_id($invoice->account->user->id)->get();

        $invoice_descriptions = json_decode($invoice->invoice_description);

        return view('invoice.edit',compact('user', 'invoice', 'inventories', 'taxes', 'invoice_descriptions'));
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

        $invoice = Invoice::find($request->id);

        $invoice->recipient_name = $request->recipient_name;
        $invoice->recipient_address = $request->recipient_address;
        $invoice->date_issued = $request->date_issued;
        $invoice->payment_due = $request->payment_due;
        $invoice->recipient_description = $request->recipient_description;
        $invoice->invoice_description = json_encode($request->invoice_description);
        $invoice->sum_total = $request->sum_total;
        $invoice->sub_total = $request->sub_total;
        $invoice->sum_tax1 = $request->sum_tax1;
        $invoice->sum_tax2 = $request->sum_tax2;
        $invoice->invoice_footer = $request->invoice_footer;
        $invoice->save();

        return  response()->json(['success'=>'Your changed to ' . $invoice->id . 'have been saved']);
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
            $invoice = Invoice::find($id);
            if (file_exists($invoice->attach_pdf))
            {
                unlink($invoice->attach_pdf);
            }
            $invoice->delete();
            return redirect()->route('invoice.index')->with('success',__('Invoice Successfully Deleted'));
        }
    }

    // public function generatePDF(Request $request)
    // {
    //     $user = Auth::user();
    //     $currentLang = $user->profile->lang;
    //     \App::setLocale($currentLang);

    //     $invoice = Invoice::find($request->id);

    //     $taxes = Tax::whereUser_id($invoice->account->user->id)->get();

    //     $invoice_descriptions = json_decode($invoice->invoice_description);

    //     $pdf_name = $invoice->recipient_name . '_invoice_' . $invoice->id . '.pdf';

    //     if (!file_exists('uploads/attach_files'))
    //     {
    //         mkdir('uploads/attach_files', 0777 , true);
    //     }

    //     $invoice->attach_pdf = $pdf_name;
    //     $invoice->save();

    //     $pdf = Barry_PDF::loadView('invoice.pdf_preview', compact('user','invoice','taxes','invoice_descriptions'));

    //     $pdf->save('uploads/attach_files/' . $pdf_name);
    //     return response()->json(['success'=>'PDF Successfully generated.']);
    // }

    public function generatePDF(Request $request)
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        $invoice = Invoice::find($request->id);

        $taxes = Tax::whereUser_id($invoice->account->user->id)->get();

        $invoice_descriptions = json_decode($invoice->invoice_description);

        $pdf_name = $invoice->recipient_name . '_invoice_' . $invoice->id . '.pdf';

        if (!file_exists('uploads/attach_files'))
        {
            mkdir('uploads/attach_files', 0777 , true);
        }

        $invoice->attach_pdf = $pdf_name;
        $invoice->save();

        $view = \View::make('invoice.pdf_make', compact('user','invoice','taxes','invoice_descriptions'));
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

        $invoice = Invoice::find($id);

        $file= public_path(). '/uploads/attach_files/'.$invoice->attach_pdf;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download($file, $invoice->attach_pdf, $headers);
    }

    public function print_preview($id)
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        $invoice = Invoice::find($id);

        $taxes = Tax::whereUser_id($invoice->account->user->id)->get();

        $invoice_descriptions = json_decode($invoice->invoice_description);
        
        return view('invoice.pdf_preview', compact('user','invoice','taxes','invoice_descriptions'));
    }

    public function duplicate_invoice($id)
    {
        $user = Auth::user();
        $currentLang = $user->profile->lang;
        \App::setLocale($currentLang);

        $invoice = Invoice::find($id);

        $duplicate_invoice = Invoice::create([
            'client_id' => $invoice->client_id,
            'account_id' => $invoice->account_id,
            'currency_id' => $invoice->currency_id,
            'recipient_name' => $invoice->recipient_name,
            'recipient_address' => $invoice->recipient_address,
            'date_issued' => $invoice->date_issued,
            'payment_due' => $invoice->payment_due,
            'recipient_description' => $invoice->recipient_description,
            'invoice_description' => $invoice->invoice_description,
            'sum_total' => $invoice->sum_total,
            'sub_total' => $invoice->sub_total,
            'sum_tax1' => $invoice->sum_tax1,
            'sum_tax2' => $invoice->sum_tax2,
            'invoice_footer' => $invoice->invoice_footer
        ]);
        
        return redirect()->route('invoice.edit',$duplicate_invoice->id)->with('success',__('Duplicated Invoice ' . $duplicate_invoice->id . ' for ' . $invoice->client->business_name));
    }

    public function send(Request $request, $id)
    {
        $user = Auth::user();
        $invoice = Invoice::find($id);
        if ($request->attachPDF) {
            $data = array(
                'email' => $request->toClient,
                'subject' => $request->subject,
                'from' => $invoice->account->user->email,
                'bodyMessage' => $request->mailContent,
                'file' => $invoice->attach_pdf
            );
            \Mail::to($data['email'])->send(new ClientSendInvoice($data));
        } else {
            $data = array(
                'email' => $request->toClient,
                'subject' => $request->subject,
                'bodyMessage' => $request->mailContent,
                'from' => $invoice->account->user->email,
                'bodyMessage' => $request->mailContent,
                'file' => Null
            );
            \Mail::to($data['email'])->send(new ClientSendInvoice($data));
        }
        $invoice->status = 1;
        $invoice->save();

        return redirect()->back()->with('success',__('Invoice Successfully Sended.'));

    }

    public function status_update($id, $status)
    {
        $invoice = Invoice::find($id);
        $invoice->status = $status;
        $invoice->save();
        return redirect()->back()->with('success', __('Invoice Successfully Updated.'));
    }

    public function record_store(Request $request)
    {
        $pay_record = Record::create([
            'invoice_id' => $request->invoice_id,
            'pay_value' => $request->pay_value,
            'pay_date' => $request->pay_date,
            'pay_description' => $request->pay_description,
        ]);

        $pay_sum = Record::whereInvoice_id($request->invoice_id)->select('pay_value')->sum('pay_value');
        $invoice = Invoice::find($request->invoice_id);
        if ($pay_sum >= $invoice->sum_total)
        {
            $invoice->status = 3;
            $invoice->paid_at = date('Y-m-d');
            $invoice->save();
        }
        $payment_due = date_diff(date_create($invoice->payment_due), date_create($today));
        $diff = $payment_due->format('%R%a');
        if ($diff >  0) {
            $invoice->status = 2;
            $invoice->save();
        }

        return redirect()->back()->with('success', __('Invoice Pay Record Successfully Saved.'));
    }
}
