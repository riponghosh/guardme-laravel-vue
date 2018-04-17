<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 01/02/2018
 * Time: 12:39 PM
 */

namespace Modules\Jobs\Traits;


use Modules\Company\Models\Company;
use Modules\Jobs\Models\Job;

trait JobbableUserTrait
{

    public function createdJobs()
    {
        return $this->hasManyThrough(Job::class,Company::class);
    }

    public function appliedJobs()
    {
        return $this->belongsToMany(Job::class,'job_applications_pivot',
            'user_id','job_id')
            ->withPivot('bid', 'applied_at');
    }

    public function hiredJobs()
    {
        return $this->belongsToMany(Job::class,'job_employees_pivot',
            'user_id','job_id')
            ->withPivot('wages', 'hired_at')
            ;
    }
}