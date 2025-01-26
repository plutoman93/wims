<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailNotification extends Notification
{
    use Queueable;

    protected $task;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Task Assigned: ' . $this->task->task_name) // Subject with task name
            ->line('Hello ' . $notifiable->name . ',') // Greet the user
            ->line('A new task has been assigned to you:')
            ->line('Task Name: ' . $this->task->task_name) // Task name
            ->line('Description: ' . $this->task->description) // Task description (optional)
            ->line('Due Date: ' . $this->task->due_date) // Due date (optional)
            ->action('View Task', url('/send-email/' . $this->task->user_id)) // Link to the task
            ->line('Thank you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            // 'task_id' => $this->task->id,
            // 'task_name' => $this->task->task_name,
            // 'task_detail' => $this->task->task_detail,
        ];
    }
}
