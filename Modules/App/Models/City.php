<?php

namespace Modules\App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = ['id'];

    protected $table = 'cities';

    public function county()
    {
        return $this->belongsTo(County::class);
    }
}
