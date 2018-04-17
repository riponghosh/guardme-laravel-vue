<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 20/02/2018
 * Time: 02:05 PM
 */

namespace Modules\Rating\Pivots;


use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Jobs\Models\Job;
use Modules\Rating\Models\Rating;
use Modules\Users\Models\User;

class UserJobRating extends Pivot
{
    protected $table = 'ratings_values_pivot';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class,'rating_id');
    }
}