<?php

namespace Modules\UserMessenger\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class CustomHtmlMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The custom html.
     *
     * @var string
     */
    protected $html;

    /**
     * Create a new message instance.
     *
     * @param string $html
     * @param string $subject
     */
    public function __construct($html, string $subject = null)
    {
        $this->html = $html;

        if ($subject) {
            $this->subject($subject);
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $html = $this->injectStyles($this->html);

        return $this->view('usermessenger::emails.custom', compact('html'));
    }
}
