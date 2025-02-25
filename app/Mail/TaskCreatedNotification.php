<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Task;
use Carbon\Carbon;

class TaskCreatedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $task;

    /**
     * Create a new message instance.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function build()
    {
        return $this->subject('New Task Created')
            ->view('emails.task_created')
            ->with([
                'taskName' => $this->task->task_name,
                'taskDetail' => $this->task->task_detail,
                'taskStartDate' => Carbon::parse($this->task->start_date)
                    ->locale('th')
                    ->translatedFormat('d F Y'), // แปลงเป็น วัน เดือน ปี
                'taskDueDate' => Carbon::parse($this->task->due_date)
                    ->locale('th')
                    ->translatedFormat('d F Y'), // แปลงเป็น วัน เดือน ปี
                'userName' => $this->task->user->first_name,
                'taskType' => $this->task->task_type->type_name,
            ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'งานใหม่ถูกสร้าง',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
