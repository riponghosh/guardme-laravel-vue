<?php

namespace Modules\Tickets\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Models\User;
use Modules\Tickets\Models\TicketFileMessage;

class TicketMessage extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'ticket_id', 'user_id', 'message', 'date_time_create',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function files()
    {
        return $this->hasMany(TicketFileMessage::class, 'message_id', 'id');
    }
}