<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 25/01/2018
 * Time: 04:34 PM
 */

namespace Modules\Jobs\Events;


use Modules\Jobs\Models\Job;
use Modules\Loyalty\Models\ReferralCredit;
use Modules\Users\Models\User;

class UserWasHiredOnJob
{
    /**
     * @var Job
     */
    public $job;

    public $user_id;


    /**
     * JobWasCreated constructor.
     * @param Job $job
     * @param $user_id
     */
    public function __construct(Job $job, $user_id)
    {
        $this->job = $job;
        $this->user_id = $user_id;

        $this->insertReferralCredit();
    }

    private function insertReferralCredit()
    {
        $referrer_id = User::where('id', $this->user_id)->first()->referrer_id;
        if($referrer_id){
            ReferralCredit::create([
                'job_id' => $this->job->id,
                'user_id' => $this->user_id,
                'referral_id' => $referrer_id,
                'credit' => 10
            ]);
        }
    }
}