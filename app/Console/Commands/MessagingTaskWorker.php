<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Servermessenger\Messenger\Task\TaskConsumer;

class MessagingTaskWorker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'server:start-worker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new connection to RabbitMQ server for tasks';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        TaskConsumer::processJobFromWorker();
    }
}
