<?php

namespace App\Actions;

use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class SendMailNotification
{
    public function execute(string $to, Mailable $send) : void
    {
        Mail::to($to)->send($send);
    }
}