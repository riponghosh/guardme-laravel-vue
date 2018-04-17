<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 25/01/2018
 * Time: 04:28 PM
 */

namespace Modules\Jobs\Repositories;


use Modules\Account\Models\Role;
use Modules\Jobs\Events\JobWasCreated;
use Modules\Jobs\Models\Job;
use Modules\Users\Models\User;

class JobRepository
{
    /**
     * @var Job
     */
    private $job;




    /**
     * JobRepository constructor.
     * @param Job $job
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    /**
     * @param array $data
     * @return Job
     */
    public function saveJob(array $data)
    {
        $job = $this->job->create([
            'company_id' => $data['company'],
            'title' => $data['title'],
            'slug' => $this->generateUniqueSlug($data['title']),
            'description' => $data['description'],
            'starts' => to_db_datetime($data['date']['start']),
            'ends' => to_db_datetime($data['date']['end']),
            'offer' => $data['offer'],
            'rating' => $data['rating'],
            'postcode' => $data['postcode'],
            'metadata' => json_encode([
                'broadcasts_config' => $data['broadcastsConfig'],
                'address' => $data['address'],
                'location' => [
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                ]
            ])
        ]);

        publish(new JobWasCreated($job, $data));

        return $job;
    }

    private function generateUniqueSlug($title)
    {
        $generated_slug = str_slug($title);

        while ($this->job->where('slug', $generated_slug)->count()){
            $generated_slug = str_slug($title . ' ' . str_random(3));
        }

        return $generated_slug;
    }

    /**
     * @param $jobSlug
     * @return Job | null
     */
    public function getJobBySlug($jobSlug)
    {
        return $this->job->where('slug', $jobSlug)->first();
    }

    public function getJobListings($limit = 10)
    {
        $query = $this->job
            ->latest();

        if(request('categories')){
            $categories_ids = request('categories');
            $query = $query->whereHas('categories', function ($query) use ($categories_ids){
                $query->whereIn('category_id', $categories_ids);
            });
        }

        if(request('min_offer')){
            $query = $query->where('offer', '>=', request('min_offer'));
        }
        if(request('max_offer')){
            $query = $query->where('offer', '<=', request('max_offer'));
        }

        return $query->simplePaginate($limit);
    }

    /**
     * @param $job_id
     * @return Job
     */
    public function getJobById($job_id)
    {
        return $this->job->find($job_id);
    }

    public function getJobApplicants($job_id, $limit = 10, &$total_applicants = 0)
    {
        $query = $this->job
            ->find($job_id)
            ->applicants();

        $total_applicants = $query->count();

        return $query->simplePaginate($limit);
    }

    public function getJobEmployees($job_id, $limit = 10, &$total_employees = 0)
    {
        $query = $this->job
            ->find($job_id)
            ->employees();

        $total_employees = $query->count();

        return $query->simplePaginate($limit);
    }

    /**
     * Gets available jobs for a user
     * for instance:
     * (employer) = gets jobs created by the employer
     * (job seeker) = gets jobs associated to the job seeker
     *
     * @param User|null $user
     * @return array
     */
    public function getUserActiveJobs(User $user = null, $limit = 10, &$total_active_jobs = 0)
    {
        if(!$user) $user = auth()->user();

        /**
         * @var Role $primaryRole
         */
        $primaryRole = $user->getPrimaryRole();

        $query = null;

        switch ($primaryRole->name){
            case config('guardme.acl.Employer'):
                $query = $user->createdJobs()->latest();
                break;
            case config('guardme.acl.Job_Seeker'):
                $query = $user->appliedJobs()->latest();
                break;
            default:
                $query = $this->job->latest();
                break;
        }

        if($query){
            if(request('keyword')){
                $query = $query
                    ->where('title', 'LIKE', '%' . request('keyword') . '%');
            }

            $total_active_jobs = $query->count();

            return $query->simplePaginate($limit);
        }
        return collect([]);
    }

    /**
     * Counts available jobs for a user
     * for instance:
     * (employer) = gets jobs created by the employer
     * (job seeker) = gets jobs associated to the job seeker
     *
     * @param User|null $user
     * @return int
     */
    public function getUserActiveJobStatistics(User $user = null)
    {
        if(!$user) $user = auth()->user();

        /**
         * @var Role $primaryRole
         */
        $primaryRole = $user->getPrimaryRole();

        $count = 0;


        switch ($primaryRole->name){
            case config('guardme.acl.Employer'):
                $count = $user->createdJobs()->count();
                break;
            case config('guardme.acl.Job_Seeker'):
                $count = $user->appliedJobs()->latest()->count();
                break;
        }

        return $count;
    }
}