<?php

namespace Modules\Notifications\Providers;


use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Account\Events\UserHasBeenSetup;
use Modules\Follows\Events\CommentActivityOnPost;
use Modules\Follows\Events\LikeActivityOnPost;
use Modules\Friends\Events\FriendRequestWasAccepted;
use Modules\Interests\Events\NewPublishedArticleActivity;
use Modules\Notifications\Listeners\AcceptedFriendRequestNotifications;
use Modules\Notifications\Listeners\NotifyClientsOnLikeAction;
use Modules\Notifications\Listeners\NotifyClientsOnPostCommentAction;
use Modules\Notifications\Listeners\NotifyClientsOnPublishedArticle;
use Modules\Notifications\Listeners\SendNewPostToClients;
use Modules\Posts\Events\PostWasMade;
use Modules\Privacy\Events\NewPostCreatedActivity;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
