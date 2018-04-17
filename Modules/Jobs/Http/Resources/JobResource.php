<?php

namespace Modules\Jobs\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Modules\App\Http\Resources\CategoryResource;
use Modules\App\Http\Resources\CitiesResource;
use Modules\Company\Http\Resources\CompanyResource;
use Modules\Jobs\Models\Job;

class JobResource extends Resource
{
    private static $request_user_id;

    /**
     * JobResource constructor.
     */
    public function __construct($job)
    {
        parent::__construct($job);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $applied = false;

        if(self::$request_user_id){
            // todo: check if user has applied to this job
            if($this->applicants()->where('id', self::$request_user_id)->count()){
                $applied = true;
            }
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug ?? str_slug($this->title),
            'description' => $this->description,
            'address' => [
                'line1' => $this->metadata['address']['line1'] ?? null,
                'line2' => $this->metadata['address']['line2'] ?? null,
                'line3' => $this->metadata['address']['line3'] ?? null,
                'city' => $this->metadata['address']['city'] ?? null,
                'county' => $this->metadata['address']['county'] ?? null,
            ],
            'location' => [
                'latitude' => $this->metadata['location']['latitude'] ?? 0,
                'longitude' => $this->metadata['location']['longitude'] ?? 0
            ],
            'postcode' => $this->postcode,
            'date' => [
                'start' => $this->starts,
                'end' => $this->ends
            ],
            'rating' => $this->rating,
            'offer' => $this->offer,
            'publishedOn' => [
                'date' => $this->created_at->format('Y-m-d H:i:s a'),
                'diff' => $this->created_at->diffForHumans()
            ],
            'company' => new CompanyResource($this->company),
            'categories' => CategoryResource::collection($this->categories),
            'applied' => $applied, //$this->when(self::$request_user_id, $applied)
            'total_applicants' => $this->applicants()->count(),
            'total_employees' => $this->employees()->count(),
            'completed' => $this->completed,
            'total_required_employees' => $this->number_of_employees_needed,
            'total_work_hours_per_employee' => $this->total_work_hours,
        ];
    }

    public static function collection($resource, $request_user_id = null, array $additional_data = []){
        self::$request_user_id = $request_user_id;

        // TODO: Change the auto-generated stub
        return parent::collection($resource)->additional($additional_data);
    }
}
