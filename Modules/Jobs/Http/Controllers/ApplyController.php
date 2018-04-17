<?php

namespace Modules\Jobs\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Jobs\Http\Resources\ApplicantsResource;
use Modules\Jobs\Jobs\ApplyToJob;
use Modules\Jobs\Repositories\JobRepository;

class ApplyController extends Controller
{
    /**
     * @var JobRepository
     */
    private $jobRepository;

    /**
     * ApplyController constructor.
     * @param JobRepository $jobRepository
     */
    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function applyToJob($job_id)
    {
        $job = $this->jobRepository->getJobById($job_id);

        publish(new ApplyToJob($job, auth()->user()->id));
    }

    public function getJobApplicants($job_id)
    {
        $total_applicants = 0;

        $applicants = $this->jobRepository->getJobApplicants($job_id, 10, $total_applicants);

        return ApplicantsResource::collection($applicants, $job_id, [
            'total' => $total_applicants
        ]);
    }
}
