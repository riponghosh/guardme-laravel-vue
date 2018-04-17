<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 19/11/2017
 * Time: 04:11 PM
 */

namespace Modules\Notifications\Listeners;


use Modules\Friends\Events\FriendRequestWasAccepted;
use Modules\Servermessenger\Messenger\Clients\MessageSender;
use Modules\Users\Models\User;
use Modules\Users\Repositories\UsersRepository;

class AcceptedFriendRequestNotifications
{


    public function handle(FriendRequestWasAccepted $event)
    {
        /**
         * @var User $user
         * @var User $friend
         */
        $user = app(UsersRepository::class)->getUserById($event->user_id);
        $friend = app(UsersRepository::class)->getUserById($event->friend_id);

        $this->browserNotification($user);
        $this->browserNotification($friend);
    }

    private function browserNotification(User $user)
    {
        $response = [
            'data' => [
                'totalFollowers' => $user->followers()->count(),
                'newFriend' => $user->friends()->get()->last()
            ],
            'meta' => [
                'emit_event' => 'followers.update'
            ]
        ];

        MessageSender::sendMessage(json_encode($response),
            "clients.$user->id.followers.update");
    }
}