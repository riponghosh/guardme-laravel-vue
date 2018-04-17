<?php

namespace Modules\Tickets\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Tickets\Traits\MessageTrait;
use Modules\Tickets\Repositories\TicketRepository;
use Modules\Tickets\Repositories\TicketMessageRepository;
use Modules\Tickets\Repositories\TicketFileMessageRepository;

class MessageController extends Controller
{
    use MessageTrait;

    private $ticket;

    private $ticketMessages;

    private $ticketFileMessage;

    public function __construct(
        TicketRepository $ticket,
        TicketMessageRepository $ticketMessages,
        TicketFileMessageRepository $ticketFileMessage)
    {
        $this->ticket = $ticket;
        $this->ticketMessages = $ticketMessages;
        $this->ticketFileMessage = $ticketFileMessage;
    }

    public function store(Request $request, $ticketId)
    {
        $errors = $this->messageStore($request, $ticketId);
        return back()->withInput()->with('errors', $errors);
    }
}
