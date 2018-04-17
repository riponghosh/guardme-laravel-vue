<?php

namespace Modules\Tickets\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Models\User;

class Ticket extends Model
{
    const STATUS_PROCESSING = 0;

    const STATUS_AWAITING_YOUR_FEEDBACK = 1;

    const STATUS_RESOLVED = 2;

    const STATUS_EXTERNAL_ARBITRATOR = 3;


    const STATE_OFF = 0;

    const STATE_ON = 1;


    const RESPONSIBLE_NO = 0;

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'responsible_id', 'category_id', 'title', 'status', 'state',
    ];

    public function userResponsible()
    {
        return $this->hasOne(User::class, 'id', 'responsible_id');
    }

    public function userCreate()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}