<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 04/10/2017
 * Time: 05:04 PM
 */

namespace Modules\Servermessenger\Messenger\Task;
use Modules\Servermessenger\Messenger\MessengerAbstract;

class TaskConsumer extends MessengerAbstract
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


    public static function processJobFromWorker($queue = 'workers')
    {
        $sender = new self();

        $sender
            ->openConnection()
            ->processJob($queue)
            ->closeConnection();
    }

    public function processJob($queue = 'workers'){
        $this->channel->queue_declare($queue, false, true, false, false);

        echo ' [' . date('Y-m-d h:i:s A') . '] Waiting for jobs. To exit press CTRL+C', "\n";

        $worker = $this;

        $callback = function($msg) use ($worker){

            $worker->execute($msg->body);


            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);

        };

        $this->channel->basic_qos(null, 1, null);
        $this->channel->basic_consume($queue, '', false, false, false, false, $callback);

        while(count($this->channel->callbacks)) {
            $this->channel->wait();
        }
        return $this;
    }

    /**
     * @param $message
     */
    protected function execute($message)
    {
        $process = unserialize($message);

        if(method_exists($process, 'handle')){
            //
            /**
             * this is a job
             *
             * Instantiate and build the job from serialized data
             * @var TaskableJob $job
             */

            $process->handle();
        } else {
            // todo: this is an event

            event($process);
        }

        echo " [ " . date('Y-m-d h:i:s a') . " ] Processed: ", get_class($process), "\n";

        return ;
    }
}