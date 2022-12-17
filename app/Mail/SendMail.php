<?php

namespace App\Mail;

use App\Checkout;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $orderdetails = [];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Checkout $order, $orderdetails)
    {
        //
        $this->order = $order;
        $this->orderdetails = $orderdetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.send_mails');
    }
}
