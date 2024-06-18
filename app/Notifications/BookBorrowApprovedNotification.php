<?php

namespace App\Notifications;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookBorrowApprovedNotification extends Notification
{
    use Queueable;

    public $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function via($notifiable)
    {
        return ['database']; // You can add other channels here like 'mail', 'broadcast', etc.
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Your borrow request has been approved:')
                    ->line('Book: ' . $this->book->title)
                    ->line('Enjoy reading!')
                    ->line('Please return the book on time.');
    }

    public function toArray($notifiable)
    {
        return [
            'book_id' => $this->book->id,
            'title' => $this->book->title,
            'message' => 'Your borrow request has been approved.',
        ];
    }
}
