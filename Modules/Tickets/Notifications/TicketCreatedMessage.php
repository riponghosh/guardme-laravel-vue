<?php

namespace Modules\Tickets\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TicketCreatedMessage extends Notification
{
    use Queueable;

    private $ticketId;

    private $title;

    private $isMyTicket;

    private $category;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ticketId, $title, $category, $isMyTicket = false)
    {
        $this->ticketId = $ticketId;
        $this->title = $title;
        $this->isMyTicket = $isMyTicket;
        $this->category = $category;
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
        $message = 'You created a ticket';

        if (!$this->isMyTicket) {
            $message = auth()->user()->username . ' has created ticket';
        }

        return (new MailMessage)->line($message . ' <a href="'. Route('ticket.show', $this->ticketId) .'">' . $this->title . '</a> from category ' . $this->category);
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
