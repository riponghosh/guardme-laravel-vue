<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 25/01/2018
 * Time: 04:34 PM
 */

namespace Modules\Jobs\Events;


use Modules\Jobs\Models\Job;

class JobWasBidded
{
    /**
     * @var Job
     */
    public $job;

    public $user_id;
    public $bidAmount;


    /**
     * JobWasCreated constructor.
     * @param Job $job
     * @param $user_id
     * @param $bidAmount
     */
    public function __construct(Job $job, $user_id, $bidAmount)
    {
        $this->job = $job;
        $this->user_id = $user_id;
        $this->bidAmount = $bidAmount;
    }
}