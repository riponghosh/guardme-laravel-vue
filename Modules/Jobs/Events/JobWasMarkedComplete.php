<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 05/03/2018
 * Time: 03:07 PM
 */

namespace Modules\Jobs\Events;


use Modules\Jobs\Models\Job;

class JobWasMarkedComplete
{
    /**
     * @var Job
     */
    public $job;


    /**
     * JobWasMarkedComplete constructor.
     * @param Job $job
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
    }
}