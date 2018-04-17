<?php

namespace Modules\UserMessenger\Contracts;

abstract class SMSProviderContract
{
    /**
     * Send plain SMS to number.
     *
     * @param string $phone
     * @param string $message
     *
     * @return mixed
     */
    abstract public function send(string $phone, string $message);
}
