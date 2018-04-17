<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CloseAccountRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $reasons;
    public $more_info;
    public $email;
    public function __construct($data)
    {
        $this->reasons = explode(',', $data['reasons']);
        $this->more_info = $data['more_info'];
        $this->email = $data['email'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('welcome.ayaz@gmail.com')
            ->view('profile::profile.partials._close-request-email-body');
    }
}
