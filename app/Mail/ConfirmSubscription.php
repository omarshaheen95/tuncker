<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmSubscription extends Mailable
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
        $subject = 'تم تأكيد عملية الإشتراك في برنامج التراكر';
        return $this->view('emails.confirm_account')
                ->from('administration@arabic-uae.com', $name)
                ->subject($subject);
    }
}
