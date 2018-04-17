<?php

namespace Modules\Jobs\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Jobs\Http\Resources\JobEmployeesResource;
use Modules\Jobs\Jobs\HireUser;
use Modules\Jobs\Repositories\JobRepository;

class HireController extends Controller
{
    /**
     * @var JobRepository
     */
    private $jobRepository;

    /**
     * HireController constructor.
     * @param JobRepository $jobRepository
     */
    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function hireUser($job_id)
    {
        $job = $this->jobRepository->getJobById($job_id);

        publish(new HireUser($job, \request()->all()));
    }

    public function getJobEmployees($job_id)
    {
        $total_employees = 0;

        $employees = $this->jobRepository->getJobEmployees($job_id, 10, $total_employees);

        return JobEmployeesResource::collection($employees, [
            'total' => $total_employees
        ]);
    }
}
