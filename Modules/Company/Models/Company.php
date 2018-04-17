<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Jobs\Models\Job;
use Modules\Users\Models\User;

class Company extends Model
{
    protected $guarded = ['id'];

    protected $table = 'companies';

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
