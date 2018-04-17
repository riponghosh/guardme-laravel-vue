<?php

namespace Modules\UserMessenger\Channels;

use Illuminate\Contracts\Mail\Mailer;

class Email extends AbstractChannel
{
    /**
     * Email constructor.
     *
     * @param Mailer $service
     */
    public function __construct(Mailer $service)
    {
        $this->service = $service;
    }

    /**
     * Send e-mail letter.
     *
     * @param $recipient
     * @param $mail
     * @param array $data
     *
     * @return void
     */
    public function send($recipient, $mail, $data)
    {
        $this->service
            ->to($recipient)
            ->send(new $mail(...$data));
    }
}
