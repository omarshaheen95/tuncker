<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewSubscription extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'administration@arabic-uae.com';
        $name = 'A.B.T';
        $subject = 'عملية إشتراك تجريببية في برنامج التراكر';
        return $this->view('emails.trial_account')
                ->from('administration@arabic-uae.com', $name)
                ->subject($subject);
    }
}
