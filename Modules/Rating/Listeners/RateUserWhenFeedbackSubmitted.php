<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 05/03/2018
 * Time: 01:49 PM
 */

namespace Modules\Rating\Listeners;


use Modules\Feedback\Events\FeedbackWasSubmitted;
use Modules\Rating\Jobs\RatePersonnelOnJob;

class RateUserWhenFeedbackSubmitted
{
    public function handle(FeedbackWasSubmitted $event)
    {
        $data = $event->data;

        $ratings = $data['feedback']['ratings'];
        $user_id = $data['user'];
        $job_id = $data['job'];

        foreach ($ratings as $submitted_rating){
            publish(new RatePersonnelOnJob($user_id,$job_id,$submitted_rating['ratingId'], $submitted_rating['value']));
        }
    }

}