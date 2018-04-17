<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 12/02/2018
 * Time: 02:27 PM
 */

namespace Modules\Jobs\Jobs;


use Modules\Jobs\Events\JobWasBidded;
use Modules\Jobs\Models\Job;

class ApplyToJob
{
    /**
     * @var Job
     */
    private $job;
    private $user_id;
    private $bidAmount;

    /**
     * ApplyToJob constructor.
     * @param Job $job
     * @param $user_id
     * @param $bidAmount
     */
    public function __construct(Job $job, $user_id, $bidAmount = 0)
    {
        $this->job = $job;
        $this->user_id = $user_id;
        $this->bidAmount = $bidAmount;
    }

    public function handle()
    {
        $this->job->applicants()->attach($this->user_id,
            [
                //'bid' => $this->bidAmount,
                'applied_at' => date('Y-m-d')
            ]);

        // publish(new JobWasBidded($this->job, $this->user_id, $this->bidAmount));
    }

}