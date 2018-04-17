<?php

namespace Modules\Tickets\Repositories;

use Modules\Tickets\Models\TicketMessage;

class TicketMessageRepository
{
    public function create(array $data)
    {
        $result = TicketMessage::create($data);

        return $result->id;
    }

    public function getByTicketId($id)
    {
        return TicketMessage::with('files')->where('ticket_id', $id)->get();
    }
}