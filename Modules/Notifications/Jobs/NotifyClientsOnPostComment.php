<?php

namespace Modules\Notifications\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Comments\Http\Resources\CommentResource;
use Modules\Comments\Models\Comment;
use Modules\Posts\Models\Post;
use Modules\Servermessenger\Messenger\Clients\MessageSender;

class NotifyClientsOnPostComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Post
     */
    private $post;
    /**
     * @var Comment
     */
    private $comment;


    /**
     * Create a new job instance.
     *
     * @param Post $post
     * @param Comment $comment
     */
    public function __construct(Post $post, Comment $comment)
    {

        $this->post = $post;
        $this->comment = $comment;
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

        $response = [
            'data' => [
                'comment' => new CommentResource($this->comment),
                'rootCommentableId' => $post->id,
                'totalRootComments' => $post->countComments()
            ],
            'meta' => [
                'emit_event' => 'feeds.comments'
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
