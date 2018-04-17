<?php

namespace Modules\Notifications\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Posts\Models\Post;
use Modules\Servermessenger\Messenger\Clients\MessageSender;

class NotifyClientsOnPostLike implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Post
     */
    private $post;

    /**
     * @var
     */
    private $likeStatus;
    /**
     * @var
     */
    private $user_id;


    /**
     * Create a new job instance.
     *
     * @param Post $post
     * @param $user_id
     * @param $likeStatus
     */
    public function __construct(Post $post, $user_id, $likeStatus)
    {

        $this->post = $post;
        $this->likeStatus = $likeStatus;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     *
     * @return void
     */
    public function handle()
    {
        $post = $this->post;
        $likeStatus = $this->likeStatus;

        $response = [
            'data' => [
                'id' => $post->id,
                'likedBy' => $this->user_id,
                'liked' => $likeStatus,
                'totalLikes' => $post->countLikes()
            ],
            'meta' => [
                'emit_event' => 'feeds.likes'
            ]
        ];

        // todo: notify the author of the post
        MessageSender::sendMessage(json_encode($response),
            "clients.$post->user_id.feeds.$post->id.like");


        // todo: notify users connected to this post of its liked status
        $followers = $this->post->users_following_post()->get();

        foreach ($followers as $follower) {
            MessageSender::sendMessage(json_encode($response),"clients.$follower->id.feeds.$post->id.like");
        }
    }
}
