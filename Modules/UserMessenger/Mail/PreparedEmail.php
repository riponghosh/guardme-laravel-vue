<?php

namespace Modules\UserMessenger\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class PreparedEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The view name.
     *
     * @var string
     */
    protected $template;

    /**
     * The view data.
     *
     * @var string
     */
    protected $data;

    /**
     * Create a new message instance.
     *
     * @param string $template
     * @param array $data
     * @param string $subject
     */
    public function __construct(string $template, array $data, string $subject = 'GuardMe')
    {
        $this->data     = $data;
        $this->template = $template;

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
        $html = $this->injectStyles(view($this->template, $this->data)->render());

        return $this->view('usermessenger::emails.custom', compact('html'));
    }
}
