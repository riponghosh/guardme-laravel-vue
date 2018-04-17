<?php

namespace Modules\Tickets\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Tickets\Traits\TicketTrait;
use Modules\Tickets\Traits\MessageTrait;
use Modules\Tickets\Repositories\TicketRepository;
use Modules\Tickets\Repositories\TicketMessageRepository;
use Modules\Tickets\Repositories\TicketFileMessageRepository;

class TicketController extends Controller
{
    use TicketTrait, MessageTrait;

    private $moduleName = 'tickets';

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

    public function index(Request $request)
    {
        if ($request->page == 1) {
            $result = redirect()->route('ticket.index');
        } else {
            $result = view($this->moduleName . '::index', [
                'tickets'       => $this->getTickets(),
                'statuses'      => $this->statuses,
                'stateOf'       => $this->stateOf,
                'statusClasses' => $this->statusClasses,
            ]);
        }

        return $result;
    }

    public function create()
    {
        if (!$this->checkRole([config('guardme.acl.Job_Seeker'), config('guardme.acl.Employer')])) {
            abort(404);
        }

        return view($this->moduleName . '::create', [
            'categories' => $this->categories,
        ]);
    }

    public function store(Request $request)
    {
        if (!$this->checkRole([config('guardme.acl.Job_Seeker'), config('guardme.acl.Employer')])) {
            abort(404);
        }

        $errors = $this->ticketStore($request);
        
        return back()->with('errors', $errors)
            ->with('status', ($errors) ? 500 : 200);
    }

    public function show($id)
    {
        if ($this->checkRole([config('guardme.acl.Job_Seeker'), config('guardme.acl.Employer')]) && $this->validationShow($id)) {
            abort(404);
        }

        return view($this->moduleName . '::show', [
            'ticket'        => $this->ticket->find($id),
            'messages'      => $this->ticketMessages->getByTicketId($id),
            'files'         => $this->ticketFileMessage->getByTicketId($id),
            'categories'    => $this->categories,
            'statuses'      => $this->statuses,
            'stateOf'       => $this->stateOf,
            'statusClasses' => $this->statusClasses,
        ]);
    }

    public function update(Request $request, $id)
    {
        $errors = $this->updateTicket($request, $id);

        $type = 'assign';

        if ($request->change_status) {
            $type = 'status';
        } elseif ($request->change_state) {
            $type = 'state';
        }

        return back()->withInput()
            ->with('errors', $errors)
            ->with('type', $type);
    }
}
