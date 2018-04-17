<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 04/10/2017
 * Time: 05:04 PM
 */

namespace Modules\Servermessenger;


use Illuminate\Queue\Jobs\Job;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Sender
{
    /**
     * @var AMQPStreamConnection $connection
     */
    private $connection;

    /**
     * @var AMQPChannel $channel
     */
    private $channel;

    private $exchange;
    private $type;
    private $passive;
    private $durable;
    private $auto_delete;

    /**
     * Sender constructor.
     */
    public function __construct()
    {
        $this->setType();
        $this->setAutoDelete();
        $this->setDurable();
        $this->setExchange();
        $this->setPassive();
    }


    public static function sendJobToWorker(Job $job)
    {
        $sender = new self();

        $sender
            ->openConnection()
            ->send($job)
            ->closeConnection();
    }

    public function send($data, $routing_key = 'system.workers'){
        $this->channel->exchange_declare($this->exchange, $this->type, false, false, false);

        $msg = new AMQPMessage($data);

        $this->channel->basic_publish($msg, $this->exchange, $routing_key);

        // $message = is_object($data) ? get_class($data) : $data;

        echo " [x] Sent ",$routing_key,': ',$data," \n";

        return $this;
    }

    public function setAutoDelete($autoDelete = false)
    {
        $this->auto_delete = $autoDelete;

        return $this;
    }

    public function setDurable($durable = false)
    {
        $this->durable = $durable;

        return $this;
    }

    public function setPassive($passive = false)
    {
        $this->passive = $passive;

        return $this;
    }

    public function setExchange($exhange = 'app')
    {
        $this->exchange = $exhange;

        return $this;
    }

    public function setType($type = 'topic')
    {
        $this->type = $type;

        return $this;
    }

    public function openConnection(){
        $this->connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

        $this->channel = $this->connection->channel();

        return $this;
    }

    public function closeConnection()
    {
        $this->channel->close();
        $this->connection->close();
    }
}