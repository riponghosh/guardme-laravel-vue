<?php

namespace Modules\Tickets\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Tickets\Traits\MessageTrait;
use Modules\Tickets\Repositories\TicketRepository;
use Modules\Tickets\Repositories\TicketMessageRepository;

class MessageController extends Controller
{
    use MessageTrait;

    private $ticket;

    private $ticketMessages;

    public function __construct(
        TicketRepository $ticket,
        TicketMessageRepository $ticketMessages)
    {
        $this->ticket = $ticket;
        $this->ticketMessages = $ticketMessages;
    }

    public function store(Request $request, $ticketId)
    {
        $errors = $this->messageStore($request, $ticketId);

        return response()->json([
            'status' => $errors ? 500 : 200,
            'errors' => $errors,
        ]);
    }
}
