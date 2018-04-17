<?php

namespace Modules\Notifications\Listeners;

use Modules\Follows\Events\LikeActivityOnPost;
use Modules\Notifications\Jobs\NotifyClientsOnPostLike;
use Modules\Servermessenger\Messenger\Task\TaskProducer;

class NotifyClientsOnLikeAction
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
     * @param LikeActivityOnPost $event
     * @return void
     */
    public function handle(LikeActivityOnPost $event)
    {
        TaskProducer::publish(new NotifyClientsOnPostLike($event->post, $event->user_id, $event->likeStatus));
    }
}
