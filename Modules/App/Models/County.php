<?php

namespace Modules\App\Models;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    protected $guarded = ['id'];

    protected $table = 'counties';

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
