<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 12/03/2018
 * Time: 05:47 PM
 */

namespace Modules\Feedback\Repositories;


use Modules\Account\Models\Role;
use Modules\Users\Models\User;

class FeedbackRepository
{

    /**
     * Gets available jobs for a user
     * for instance:
     * (employer) = gets jobs created by the employer
     * (job seeker) = gets jobs associated to the job seeker
     *
     * @param User|null $user
     * @return array
     */
    public function getUserFeedback(User $user = null, $limit = 10, &$total_active_jobs = 0)
    {
        if(!$user) $user = auth()->user();

        /**
         * @var Role $primaryRole
         */
        $primaryRole = $user->getPrimaryRole();

        $query = null;

        switch ($primaryRole->name){
            case config('guardme.acl.Employer'):
                $query = $user->ratings()->latest();
                break;
            case config('guardme.acl.Job_Seeker'):
                $query = $user->appliedJobs()->latest();
                break;
            default:
                $query = $this->job->latest();
                break;
        }

        if($query){
            if(request('keyword')){
                $query = $query
                    ->where('title', 'LIKE', '%' . request('keyword') . '%');
            }

            $total_active_jobs = $query->count();

            return $query->simplePaginate($limit);
        }
        return collect([]);
    }

}