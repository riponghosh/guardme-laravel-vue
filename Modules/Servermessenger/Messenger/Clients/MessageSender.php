<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 05/10/2017
 * Time: 02:18 PM
 */

namespace Modules\Servermessenger\Messenger\Clients;

use Modules\Servermessenger\Messenger\MessengerAbstract;
use PhpAmqpLib\Message\AMQPMessage;

class MessageSender extends MessengerAbstract
{


    /**
     * MessageSender constructor.
     */
    public function __construct()
    {
        $this->setType();
        $this->setAutoDelete();
        $this->setDurable(true);
        $this->setExchange('amq.topic');
        $this->setPassive();
    }

    public static function sendMessage($message, $routing_key, $sendAsQueue = false)
    {
        $sender = new self();

        $sender
            ->openConnection()
            ->send($message, $routing_key, $sendAsQueue)
            ->closeConnection();
    }

    public function send($data, $routing_key = 'system.*', $sendAsQueue){
        if($sendAsQueue){
            $this->channel->queue_declare(
                $routing_key,
                false,
                false,
                false,
                true);
        } else {
            $this->channel->exchange_declare(
                $this->exchange,
                $this->type,
                false,
               true,
                false
            );
        }

        $msg = $this->setMessage($data);

        if($sendAsQueue) $this->setExchange('');

        $this->channel->basic_publish($msg, $this->exchange, $routing_key);

        return $this;
    }

    protected function setMessage($data): AMQPMessage
    {
        return new AMQPMessage($data/*,
            array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)*/
        );
    }
}