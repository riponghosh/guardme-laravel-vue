<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 05/10/2017
 * Time: 02:08 PM
 */

namespace Modules\Servermessenger\Messenger;


use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

abstract class MessengerAbstract
{
    protected $exchange;
    protected $type;
    protected $passive;
    protected $durable;
    protected $auto_delete;

    /**
     * @var AMQPStreamConnection $connection
     */
    protected $connection;

    /**
     * @var AMQPChannel $channel
     */
    protected $channel;

    public function openConnection(){
        $this->connection = new AMQPStreamConnection('localhost', 5672,
            config('guardme.rabbitmq.auth.user'), config('guardme.rabbitmq.auth.password'));

        $this->channel = $this->connection->channel();

        return $this;
    }

    public function closeConnection()
    {
        $this->channel->close();
        $this->connection->close();
    }

    /**
     * @param $data
     * @return AMQPMessage
     */
    protected function setMessage($data): AMQPMessage
    {
        return new AMQPMessage($data);
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
}