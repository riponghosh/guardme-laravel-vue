<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 23/11/2017
 * Time: 11:01 AM
 */

namespace Modules\Notifications\Listeners;


use Modules\Interests\Events\NewPublishedArticleActivity;
use Modules\Posts\Http\Resources\PostResource;
use Modules\Servermessenger\Messenger\Clients\MessageSender;

class NotifyClientsOnPublishedArticle
{

    public function handle(NewPublishedArticleActivity $event)
    {
        $post = $event->article;

        $postResource = new PostResource($post);

        $response = [
            'data' => $postResource,
            'meta' => [
                'emit_event' => 'feeds.new'
            ]
        ];

        $client_ids = $post->privileged_users()->pluck('id')->toArray();

        foreach ($client_ids as $client_id){
            MessageSender::sendMessage(json_encode($response), "clients.$client_id.feeds.new");
        }
    }
}