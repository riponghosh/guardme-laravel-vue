<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 04/10/2017
 * Time: 05:04 PM
 */

namespace Modules\Servermessenger\Messenger\Task;

use Modules\Servermessenger\Messenger\MessengerAbstract;
use PhpAmqpLib\Message\AMQPMessage;

class TaskProducer extends MessengerAbstract
{

    /**
     * Receiver constructor.
     */
    public function __construct()
    {
        $this->setType();
        $this->setAutoDelete(true);
        $this->setDurable(true);
        $this->setExchange();
        $this->setPassive();
    }

    public static function publish($task)
    {
        $sender = new self();

        $sender
            ->openConnection()
            ->sendTask($task)
            ->closeConnection();

        return;
    }

    protected function sendTask($task, $queue = "workers"){
        $this->channel->queue_declare($queue, false, true, false, false);

        $data = serialize($task);

        if(empty($data)) die('No event published.');

        $msg = new AMQPMessage($data,
            array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
        );

        $this->channel->basic_publish($msg, '', $queue);

        \Log::info(date('Y-m-d H:i:s a') . ": Published " . get_class($task) . "\r");

        return $this;
    }
}