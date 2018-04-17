<?php

namespace Modules\Tickets\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TicketSendMessage extends Notification
{
    use Queueable;

    private $ticketId;

    private $userName;

    private $title;

    private $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ticketId, $userName, $title, $message)
    {
        $this->ticketId = $ticketId;
        $this->userName = $userName;
        $this->title = $title;
        $this->message = $message;
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
        return (new MailMessage)->line($this->userName . ' sent you a message "' . $this->message . '" on the ticket <a href="'. Route('ticket.show', $this->ticketId) .'">' . $this->title . '</a>');
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
