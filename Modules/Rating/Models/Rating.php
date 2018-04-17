<?php

namespace Modules\Rating\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Rating\Pivots\UserJobRating;
use Modules\Users\Models\User;

class Rating extends Model
{
    protected $guarded = ['id'];

    protected $table = 'ratings';

    public function users()
    {
        return $this->belongsToMany(User::class,'ratings_values_pivot',
            'user_id','rating_id')
            ->using(UserJobRating::class)
            ->as('user_job_rating')
            ->withPivot('job_id','value','metadata')
            ;
    }
}
