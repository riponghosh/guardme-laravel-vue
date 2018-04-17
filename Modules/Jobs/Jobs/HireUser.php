<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 12/02/2018
 * Time: 02:27 PM
 */

namespace Modules\Jobs\Jobs;


use Modules\Jobs\Events\JobWasBidded;
use Modules\Jobs\Events\UserWasHiredOnJob;
use Modules\Jobs\Models\Job;

class HireUser
{
    /**
     * @var Job
     */
    private $job;
    /**
     * @var array
     */
    private $data;

    /**
     * ApplyToJob constructor.
     * @param Job $job
     * @param array $data
     */
    public function __construct(Job $job, array $data)
    {
        $this->job = $job;
        $this->data = $data;
    }

    public function handle()
    {
        $this->job->employees()->attach($this->data['user_id'],
            [
                'wages' => $this->data['wages'],
                'hired_at' => date('Y-m-d')
            ]);

        publish(new UserWasHiredOnJob($this->job, $this->data['user_id']));
    }

}