<?php

namespace App\Mail;

use App\Checkout;
use App\OrderPitches;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailPitches extends Mailable
{
    use Queueable, SerializesModels;
    public $pitches;
    public $pitch;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(OrderPitches $pitches, $pitch)
    {
        //
        $this->pitches = $pitches;
        $this->pitch = $pitch;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.send_mail_pitches');
    }
}
