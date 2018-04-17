<?php

namespace Modules\Notifications\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Posts\Http\Resources\PostResource;
use Modules\Posts\Models\Post;
use Modules\Servermessenger\Messenger\Clients\MessageSender;
use Modules\Users\Models\User;

class NotifyClientsOnNewPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Post
     */
    private $post;


    /**
     * Create a new job instance.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {

        $this->post = $post;
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

        $postResource = new PostResource($post);

        $response = [
            'data' => $postResource,
            'meta' => [
                'emit_event' => 'feeds.new'
            ]
        ];

        if($post->privacy == config('talkstuff.privacy.PUBLIC')) {
            MessageSender::sendMessage(json_encode($response), "clients.public.feeds.new");
        } else {
            $client_ids = $post->privileged_users()->pluck('id')->toArray();

            foreach ($client_ids as $client_id){
                MessageSender::sendMessage(json_encode($response), "clients.$client_id.feeds.new");
            }
        }

    }
}
