<?php

namespace Modules\Tickets\Traits;

use \Modules\Users\Models\User;
use \Modules\Account\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\Tickets\Models\Ticket;
use Modules\Tickets\Notifications\TicketCreatedMessage;
use Modules\Tickets\Notifications\TicketResponsibleMessage;
use Modules\Tickets\Notifications\TicketStatusMessage;
use Modules\Tickets\Notifications\TicketStateMessage;

trait TicketTrait
{
    private $categories = [
        'Payment Issue',
        'Account changes',
        'Security Badge Verification',
        'Job Dispute',
        'General',
    ];

    private $statuses = [
        Ticket::STATUS_PROCESSING             => 'Processing',
        Ticket::STATUS_AWAITING_YOUR_FEEDBACK => 'Awaiting your feedback',
        Ticket::STATUS_RESOLVED               => 'Resolved',
        Ticket::STATUS_EXTERNAL_ARBITRATOR    => 'External Arbitrator',
    ];

    private $stateOf = [
        'Closed',
        'Opened',
    ];

    private $statusClasses = [
        'info',
        'warning',
        'success',
        'danger',
    ];

    private function ticketStore($request)
    {
        $errors = $this->validationTicket($request);

        if (!$errors) {
            $ticketId = $this->saveTicket($request);
            $this->saveMessage($request, $ticketId);
            $this->ticketCreatedMessage($request, $ticketId);
        }

        return $errors;
    }

    private function checkRole(array $roles)
    {
        $user = auth()->user();
        $check = false;

        if ($user->inRoles($roles)) {
            $check = true;
        }

        return $check;
    }

    private function getTickets()
    {
        $tickets = null;

        if ($this->checkRole(['Job seeker', 'Employer'])) {
            $user = auth()->user();
            $tickets = $this->ticket->getBy('user_id', $user->id);
        }

        if ($this->checkRole(['Partner', 'Admin'])) {
            $tickets = $this->ticket->all();
        }

        return $tickets;
    }

    private function validationTicket($request)
    {
        $rule = [
            'title'    => 'required|max:191',
            'category' => [
                'required',
                Rule::in(array_keys($this->categories))
            ],
        ];

        $rule = $rule + $this->ruleValidationMessage();

        $errors = Validator::make($request->all(), $rule)->errors()->messages();

        return $errors;
    }

    private function saveTicket($request)
    {
        return $this->ticket->create([
            'user_id'        => auth()->user()->id,
            'responsible_id' => Ticket::RESPONSIBLE_NO,
            'category_id'    => $request->category,
            'title'          => $request->title,
            'status'         => Ticket::STATUS_PROCESSING,
            'state'          => Ticket::STATE_ON,
        ]);
    }

    private function updateTicket($request, $id)
    {
        $errors = [];
        $userId = auth()->user()->id;

        switch ($request->type) {
            case 'responsible':
                $ticket = $this->ticket->updateResponsible($id, $userId);

                if ($ticket) {
                    $this->ticketResponsibleMessage($id, $userId);
                }

                break;
            case 'state_status':
                if ($request->change_status) {
                    if (!$errors = $this->validationStatus($request, $id)) {
                        $this->ticket->update($id, ['status' => $request->status]);
                        $this->ticketStatusMessage($id, $userId, $request->status);
                    }
                }

                if ($request->change_state) {
                    if (!$errors = $this->validationState($id)) {
                        $this->ticket->update($id, ['state' => Ticket::STATE_OFF]);
                        $this->ticketStateMessage($id, $userId);
                    }
                }

                break;
        }

        return $errors;
    }

    private function validationStatus($request, $id)
    {
        $data = [
            'id'     => $id,
            'status' => $request->status,
        ];

        $userId = auth()->user()->id;

        $rule = [
            'status' => [
                'required',
                Rule::in(array_keys($this->statuses)),
            ],
            'id' => [
                'required',
                Rule::exists('tickets')->where(function ($query) use ($userId) {
                    $query->where('responsible_id', $userId);
                }),
            ],
        ];

        $errors = Validator::make($data, $rule)->errors()->messages();

        return $errors;
    }

    private function validationState($id)
    {
        $data = ['id' => $id];

        $userId = auth()->user()->id;

        $rule = [
            'id' => [
                'required',
                Rule::exists('tickets')->where(function ($query) use ($userId) {
                    $query->where('responsible_id', $userId)->where('state', Ticket::STATE_ON);
                }),
            ],
        ];

        $errors = Validator::make($data, $rule)->errors()->messages();

        return $errors;
    }

    private function validationShow($id)
    {
        $data = ['id' => $id];

        $userId = auth()->user()->id;

        $rule = [
            'id' => [
                'required',
                Rule::exists('tickets')->where(function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                }),
            ],
        ];

        $errors = Validator::make($data, $rule)->errors()->messages();

        return $errors;
    }

    private function ticketCreatedMessage($request, $id)
    {
        $user = User::find(auth()->user()->id);
        $user->notify(new TicketCreatedMessage($id, $request->title, $this->categories[$request->category], true));

        $roles = Role::with('users')->where('name', 'License partner')
            ->orWhere('name', 'Admin')
            ->get();

        if ($roles) {
            foreach ($roles as $role) {
                foreach ($role->users as $user) {
                    $user->notify(new TicketCreatedMessage($id, $request->title, $this->categories[$request->category]));
                }
            }
        }
    }

    private function ticketResponsibleMessage($id, $userId)
    {
        $ticket = $this->ticket->find($id);
        $userCreateTicket = User::find($ticket->user_id);
        $userResponsibleToTicket = User::find($userId);
        $userCreateTicket->notify(new TicketResponsibleMessage($id, $ticket->title, $userResponsibleToTicket->username));
        $userResponsibleToTicket->notify(new TicketResponsibleMessage($id, $ticket->title));
    }

    private function ticketStatusMessage($id, $userId, $status)
    {
        $ticket = $this->ticket->find($id);
        $users = User::whereIn('id', [$ticket->user_id, $userId])->get();

        foreach ($users as $user) {
            $user->notify(new TicketStatusMessage($id, $ticket->title, $this->statuses[$status]));
        }
    }

    private function ticketStateMessage($id, $userId)
    {
        $ticket = $this->ticket->find($id);
        $users = User::whereIn('id', [$ticket->user_id, $userId])->get();

        foreach ($users as $user) {
            $user->notify(new TicketStateMessage($id, $ticket->title));
        }
    }
}

