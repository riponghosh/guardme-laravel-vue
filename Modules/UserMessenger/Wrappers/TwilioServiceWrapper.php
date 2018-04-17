<?php

namespace Modules\UserMessenger\Wrappers;

use Twilio\Rest\Client;
use Modules\UserMessenger\Contracts\SMSProviderContract;

class TwilioServiceWrapper extends SMSProviderContract
{
    /**
     * The Twilio config.
     *
     * @var object
     */
    protected $config;

    /**
     * The Twilio SDK instance.
     *
     * @var Client
     */
    protected $twilio;

    /**
     * TwilioServiceWrapper constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = (object) $config;
        $this->twilio = new Client($this->config->account, $this->config->token);
    }

    /**
     * Send plain SMS message.
     *
     * @param string $phone
     * @param string $message
     *
     * @return \Twilio\Rest\Api\V2010\Account\MessageInstance
     */
    public function send(string $phone, string $message)
    {
        return $this->twilio->messages->create($phone, [
            'body' => $message,
            'from' => $this->config->from,
        ]);
    }
}

