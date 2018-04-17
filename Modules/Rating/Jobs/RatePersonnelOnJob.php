<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 05/03/2018
 * Time: 01:57 PM
 */

namespace Modules\Rating\Jobs;


use Modules\Rating\Repositories\RatingRepository;
use Modules\Users\Models\User;

class RatePersonnelOnJob
{
    /**
     * @var User
     */
    private $user;
    private $rating_id;
    private $rating_value;
    private $job_id;
    private $user_id;


    /**
     * RatePersonnel constructor.
     * @param $user_id
     * @param $job_id
     * @param $rating_id
     * @param $rating_value
     */
    public function __construct($user_id, $job_id, $rating_id, $rating_value)
    {
        $this->rating_id = $rating_id;
        $this->rating_value = $rating_value;
        $this->job_id = $job_id;
        $this->user_id = $user_id;
    }

    public function handle()
    {
        /** @var RatingRepository $rateRepo */
        $rateRepo = app(RatingRepository::class);
        $rating = $rateRepo->getRatingDefinitionById($this->rating_id);

        if($user_exists = $rating->users()
            ->wherePivot('user_id',$this->user_id)
            ->wherePivot('job_id',$this->job_id)
            ->first()){

            $user_exists->user_job_rating->update([
                'value' => $this->rating_value
            ]);

        } else {
            $rating->users()->syncWithoutDetaching([$this->user_id => [
                'value' => $this->rating_value,
                'job_id' => $this->job_id,
            ]]);
        }
    }
}