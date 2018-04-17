<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserDisapprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $body;

    public $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->body = isset($data['body']) ? $data['body'] : 'Please contact support for more information.';

        $this->subject = isset($data['title']) ? $data['title'] : 'Your account has been disapproved';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('profile::profile.partials.user-disapproved', ['body' => $this->body]);
    }
}
