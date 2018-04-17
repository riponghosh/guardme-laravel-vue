<?php

namespace Modules\Jobs\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Jobs\Http\Resources\JobResource;
use Modules\Jobs\Repositories\JobRepository;

class JobPaymentController extends Controller
{
    /**
     * @var JobRepository
     */
    private $jobRepository;

    /**
     * JobPaymentController constructor.
     * @param JobRepository $jobRepository
     */
    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function jobPaymentPage($job_slug)
    {
        $job = $this->jobRepository->getJobBySlug($job_slug);

        $job_token = generateTokenFromEntity(new JobResource($job));

        return view('jobs::job-payment', compact('job_token'));
    }
}
