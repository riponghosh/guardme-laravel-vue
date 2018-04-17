<?php

namespace Modules\Jobs\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Models\Category;
use Modules\App\Models\City;
use Modules\App\Models\Sector;
use Modules\Company\Models\Company;
use Modules\Users\Models\User;

class Job extends Model
{
    protected $guarded = ['id'];

    protected $table = 'jobs';

    protected $casts = [
        'completed' => 'boolean'
    ];

    public $dates = [
        'completed_at'
    ];

    public function getMetadataAttribute($value){
        if($value){
            return json_decode($value, true);
        } else {
            return [];
        }
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'job_sectors_pivot','job_id', 'sector_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'job_categories_pivot','job_id','category_id');
    }

    public function applicants()
    {
        return $this->belongsToMany(User::class,'job_applications_pivot','job_id','user_id')
            ->withPivot('bid','applied_at');
    }

    public function employees()
    {
        return $this->belongsToMany(User::class,'job_employees_pivot','job_id','user_id')
            ->withPivot('wages','hired_at');
    }
}
