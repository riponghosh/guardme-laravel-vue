<?php

namespace Modules\Tickets\Repositories;

use Modules\Tickets\Models\Ticket;

class TicketRepository
{
    const COUNT_IN_ONE_PAGE = 10;

    public function create(array $data)
    {
        $result = Ticket::create($data);

        return $result->id;
    }

    public function getBy($field, $value)
    {
        return Ticket::with('userResponsible')->where($field, $value)->orderBy('id', 'desc')->paginate(static::COUNT_IN_ONE_PAGE);
    }

    public function all()
    {
        return Ticket::with('userResponsible')->orderBy('id', 'desc')->paginate(static::COUNT_IN_ONE_PAGE);
    }

    public function updateResponsible($id, $responsibleId)
    {
        return Ticket::where('id', $id)->where('responsible_id', 0)->update([
            'responsible_id' => $responsibleId,
        ]);
    }

    public function update($id, array $data)
    {
        return Ticket::where('id', $id)->update($data);
    }

    public function find($id)
    {
        return Ticket::with('userResponsible', 'userCreate')->find($id);
    }
}