<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 05/03/2018
 * Time: 01:51 PM
 */

namespace Modules\Rating\Traits;


use Modules\Rating\Models\Rating;
use Modules\Rating\Pivots\UserJobRating;

trait UserRatingTrait
{
    public function ratings()
    {
        return $this->belongsToMany(Rating::class,'ratings_values_pivot',
            'rating_id','user_id')
            ->using(UserJobRating::class)
            ->as('user_job_rating')
            ->withPivot('job_id','value','metadata')
            ;
    }

    public function getUserRatingOnJob($job_id)
    {

    }

}