<?php

namespace Modules\Notifications\Listeners;

use Modules\Posts\Events\PostWasMade;
use Modules\Notifications\Jobs\NotifyClientsOnNewPost;
use Modules\Privacy\Events\NewPostCreatedActivity;
use Modules\Servermessenger\Messenger\Task\TaskProducer;

class SendNewPostToClients
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewPostCreatedActivity  $event
     * @return void
     */
    public function handle(NewPostCreatedActivity $event)
    {
        TaskProducer::publish(new NotifyClientsOnNewPost($event->post));
    }
}
