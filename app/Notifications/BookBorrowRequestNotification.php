<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\BookRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookBorrowRequestNotification extends Notification
{
    use Queueable;

    public $request;

    public function __construct(BookRequest $request)
    {
        $this->request = $request;
    }

    public function via($notifiable)
    {
        return ['database']; // You can add other channels here like 'database', 'broadcast', etc.
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('New borrow request:')
                    ->line('User: ' . $this->request->user->name)
                    ->line('Book: ' . $this->request->book->title)
                    ->action('View Request', route('admin.borrow.requests')) // Link to admin panel or requests page
                    ->line('Please review and approve.');
    }
}
