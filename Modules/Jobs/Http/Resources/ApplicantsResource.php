<?php

namespace Modules\Jobs\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Account\Http\Resources\RoleResource;
use Modules\Users\Models\User;

class ApplicantsResource extends Resource
{
    private static $job_id = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        /** @var User $user */
        $user = $this;

        $bid_amount = null;
        $bid_date = null;
        $hired = false;

        if($this->pivot){
            $bid_amount = $this->pivot->bid;
            $bid_date = $this->pivot->bid_at;
        }
        if(self::$job_id){
            if($user->hiredJobs()->wherePivot('job_id', self::$job_id)->count()) $hired = true;
        }
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'registeredAt' => $this->registered_date->format('Y-m-d'),
            'bid' => $bid_amount,
            'bid_date' => $bid_date,
            'hired' => $hired
        ];
    }

    public static function collection($resource, $job_id = null, array $additional_data = []){
        self::$job_id = $job_id;

        // TODO: Change the auto-generated stub
        return parent::collection($resource)->additional($additional_data);
    }
}
