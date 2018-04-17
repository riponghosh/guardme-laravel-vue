<?php

namespace Modules\Tickets\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\Tickets\Models\Ticket;
use \Modules\Users\Models\User;
use Modules\Tickets\Notifications\TicketSendMessage;
use Storage;

trait MessageTrait
{
    private $maxSizeUploadFile = 10000;

    private $maxCountUploadFiles = 10;

    private $uploadFilePath = 'files/ticket_attachments';

    private function messageStore($request, $ticketId)
    {
        $errors = $this->validationMessage($request, $ticketId);

        if (!$errors) {
            $this->saveMessage($request, $ticketId);
            $this->ticketSendMessage($ticketId, auth()->user()->id, $request->message);
        }
    }

    private function saveMessage($request, $ticketId)
    {
        $userId = auth()->user()->id;

        $messageId = $this->ticketMessages->create([
            'ticket_id'        => $ticketId,
            'user_id'          => $userId,
            'message'          => $request->message,
            'date_time_create' => Carbon::now(),
        ]);

        if ($request->file('files')) {
            $countFiles = count($request->file('files'));

            for ($i = 0; $i < $countFiles; $i++) {
                $file = $request->file('files')[$i];
                $name = $this->generateFileName($userId, $i, $file->extension());
                Storage::makeDirectory($this->uploadFilePath, 755);
                $file->move($this->uploadFilePath, $name);

                $this->ticketFileMessage->create([
                    'ticket_id'  => $ticketId,
                    'message_id' => $messageId,
                    'name'       => $name,
                ]);
            }
        }
    }

    private function generateFileName($userId, $fileNumber, $extension)
    {
        $time = Carbon::now()->timestamp;
        $rand = rand(1, 100000);

        return $userId . $time . $fileNumber . $rand . '.' . $extension;
    }

    private function ruleValidationMessage() {
        return [
            'message' => 'required|string',
            'files.*' => 'max:' . $this->maxSizeUploadFile,
            'files'   => 'max:' . $this->maxCountUploadFiles,
        ];
    }

    private function validationMessage($request, $ticketId)
    {
        $data = [
            'id'      => $ticketId,
            'message' => $request->message,
        ];

        $userId = auth()->user()->id;

        $rule = [
            'id' => [
                'required',
                Rule::exists('tickets')->where(function ($query) use ($userId) {
                    $query->where('state', Ticket::STATE_ON)
                        ->where('responsible_id', $userId)
                        ->orWhere('user_id', $userId);
                }),
            ],
        ];

        $rule = $rule + $this->ruleValidationMessage();

        $errors = Validator::make($data, $rule)->errors()->messages();

        return $errors;
    }

    private function ticketSendMessage($id, $userId, $message)
    {
        $ticket = $this->ticket->find($id);
        $userToSendMessageId = ($userId != $ticket->user_id) ? $ticket->user_id : $ticket->responsible_id;

        if ($userToSendMessageId) {
            $userToSendMessage = User::find($userToSendMessageId);
            $userFromSendMessage = User::find($userId);
            $userToSendMessage->notify(new TicketSendMessage($id, $userFromSendMessage->username, $ticket->title, $message));
        }
    }
}