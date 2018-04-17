<?php

namespace Modules\Tickets\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TicketStatusMessage extends Notification
{
    use Queueable;

    private $ticketId;

    private $title;

    private $status;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ticketId, $title, $status)
    {
        $this->ticketId = $ticketId;
        $this->title = $title;
        $this->status = $status;
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
        return (new MailMessage)->line('Ticket <a href="'. Route('ticket.show', $this->ticketId) .'">' . $this->title . '</a> changed its status to ' . $this->status);
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
