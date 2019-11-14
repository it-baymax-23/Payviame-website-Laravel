<?php

namespace App\Notifications;

use File;
use App\User;
use App\Profile;
use App\Inventory;
use App\Tax;
use App\Client;
use App\Quote;
use App\Invoice;
use App\Account;
use App\Team;
use App\Membership;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientSendQuote extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data = [])
    {
        //
        $this->data = $data;
    }

    public function build()
    {
        if ($this->data['file']) {
            $file = File::get(public_path('uploads/attach_files/' . $this->data['file']));
            return $this->view('quote/email')
                    ->subject($this->data['subject'])
                    ->attachData($file, $this->data['file']);
        } else {
            return $this->view('quote/email')
                    ->subject($this->data['subject']);
        }
    }
}
