<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NoticeNearExpire extends Mailable
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
        $subject = 'إشعار إقتراب إ،تهاء صلاحية الحساب';
        return $this->view('emails.near_expire')
                ->from('administration@arabic-uae.com', $name)
                ->subject($subject);
    }
}
