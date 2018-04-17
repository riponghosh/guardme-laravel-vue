<?php

namespace Modules\Tickets\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TicketResponsibleMessage extends Notification
{
    use Queueable;

    private $ticketId;

    private $userResponsibleName;

    private $title;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ticketId, $title, $userResponsibleName = null)
    {
        $this->ticketId = $ticketId;
        $this->title = $title;
        $this->userResponsibleName = $userResponsibleName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = 'You became responsible for ticket ';

        if ($this->userResponsibleName) {
            $message = $this->userResponsibleName . ' became responsible for ticket ';
        }

        return (new MailMessage)->line($message . '<a href="'. Route('ticket.show', $this->ticketId) .'">' . $this->title . '</a>');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
