<?php

namespace Modules\Jobs\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Users\Models\User;

class JobEmployeesResource extends Resource
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

        $wages = null;
        $hired_at = null;

        if($this->pivot){
            $wages = $this->pivot->wages;
            $hired_at = $this->pivot->hired_at;
        }
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'registeredAt' => $this->registered_date->format('Y-m-d'),
            'wages' => $wages,
            'hired_at' => $hired_at,
        ];
    }

    public static function collection($resource, array $additional_data = []){
        // TODO: Change the auto-generated stub
        return parent::collection($resource)->additional($additional_data);
    }
}
