<?php

namespace Modules\Notifications\Listeners;

use Modules\Follows\Events\CommentActivityOnPost;
use Modules\Notifications\Jobs\NotifyClientsOnPostComment;
use Modules\Servermessenger\Messenger\Task\TaskProducer;

class NotifyClientsOnPostCommentAction
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
     * @param CommentActivityOnPost $event
     * @return void
     */
    public function handle(CommentActivityOnPost $event)
    {
        TaskProducer::publish(new NotifyClientsOnPostComment($event->post, $event->comment));
    }
}
