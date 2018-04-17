<?php

namespace Modules\Jobs\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Account\Http\Resources\RoleResource;
use Modules\Company\Http\Resources\CompanyResource;
use Modules\Jobs\Repositories\JobRepository;
use Modules\Users\Models\User;

class UserJobProfileResource extends Resource
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserJobProfileResource constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        parent::__construct($user);
    }


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {

        if($can_return_stats = $this->user->inRoles([
            config('guardme.acl.Job_Seeker'),
            config('guardme.acl.Employer'),
        ])){
            /** @var JobRepository $jobRepository */
            $jobRepository = app(JobRepository::class);

            $active_job_count = $jobRepository->getUserActiveJobStatistics($this->user);
        }

        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'primaryRole' => new RoleResource($this->getPrimaryRole()),
            'stats' => $this->when($can_return_stats, [
                'jobs' => $active_job_count ?? 0
            ]),
            'companies' => $this->when($this->hasRole(config('guardme.acl.Employer')),
                CompanyResource::collection($this->companies))
        ];
    }
}
