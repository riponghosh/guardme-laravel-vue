<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 25/01/2018
 * Time: 04:23 PM
 */

namespace Modules\Jobs\Jobs;


use Modules\Jobs\Events\JobWasCreated;
use Modules\Jobs\Repositories\JobRepository;

class SaveJob
{
    private $user_id;
    /**
     * @var array
     */
    private $data;


    /**
     * SaveJob constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        /**
         * @var JobRepository $jobRepository
         */
        $jobRepository = app(JobRepository::class);
        $job = $jobRepository->saveJob($this->data);

    }
}