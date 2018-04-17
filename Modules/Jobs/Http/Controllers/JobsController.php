<?php

namespace Modules\Jobs\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Jobs\Events\JobWasMarkedComplete;
use Modules\Jobs\Http\Resources\ApplicantsResource;
use Modules\Jobs\Http\Resources\JobResource;
use Modules\Jobs\Http\Resources\UserJobProfileResource;
use Modules\Jobs\Jobs\ApplyToJob;
use Modules\Jobs\Jobs\SaveJob;
use Modules\Jobs\Repositories\JobRepository;
use Modules\Users\Http\Resources\UserAccountResource;
use Modules\Users\Models\User;
use Modules\Users\Repositories\UsersRepository;

class JobsController extends Controller
{
    /**
     * @var JobRepository
     */
    private $jobRepository;

    /**
     * JobsController constructor.
     * @param JobRepository $jobRepository
     */
    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function newJobPage()
    {
        return view('jobs::create-job');
    }

    public function saveJob()
    {
        $data = \request()->all();

        $job = $this->jobRepository->saveJob($data);

        return new JobResource($job);
    }

    public function schedule()
    {
        return view('jobs::job-schedule');
    }

    public function getAuthUserActiveJobs()
    {
        /**
         * @var User $user
         */
        $user = auth()->user();
        $total_active_jobs = 0;

        $jobs = $this->jobRepository->getUserActiveJobs($user, 10, $total_active_jobs);

        return JobResource::collection($jobs, $user->id, [
            'total' => $total_active_jobs
        ]);
    }

    public function showJobDetails($jobSlug)
    {
        $job = $this->jobRepository->getJobBySlug($jobSlug);

        $job_token = generateTokenFromEntity(new JobResource($job));

        return view('jobs::job-details', compact('job_token'));
    }

    public function showJobListings()
    {
        return view('jobs::job-listings');
    }

    public function getJobListings()
    {
        $jobs = $this->jobRepository->getJobListings(10);

        $user = auth()->guard('api')->user();
        $user_id = null;

        if($user) {
            $user_id = auth()->guard('api')->user()->id;
        }

        return JobResource::collection($jobs, $user_id);
    }


    public function getUserJobProfile($user_id, UsersRepository $usersRepository)
    {
        $user = $usersRepository->getUserById($user_id);

        return new UserJobProfileResource($user);
    }

    public function manageJobDetails($jobSlug)
    {
        $job = $this->jobRepository->getJobBySlug($jobSlug);

        $job_token = generateTokenFromEntity(new JobResource($job));

        return view('jobs::manage-job-details', compact('job_token'));
    }

    public function markJobAsComplete($job_id)
    {
        $job = $this->jobRepository->getJobById($job_id);

        $job->completed = true;
        $job->completed_at = date('Y-m-d');

        $job->save();

        publish(new JobWasMarkedComplete($job));

        return $job;
    }


    public function unMarkJobAsComplete($job_id)
    {
        $job = $this->jobRepository->getJobById($job_id);

        $job->completed = false;

        $job->save();

        return $job;
    }
}
