<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 25/01/2018
 * Time: 04:34 PM
 */

namespace Modules\Jobs\Events;


use Modules\Jobs\Models\Job;

class JobWasCreated
{
    /**
     * @var Job
     */
    public $job;
    /**
     * @var array
     */
    public $data;


    /**
     * JobWasCreated constructor.
     * @param Job $job
     * @param array $data
     */
    public function __construct(Job $job, array $data)
    {
        $this->job = $job;
        $this->data = $data;
    }
}