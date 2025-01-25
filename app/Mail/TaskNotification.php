<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaskNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $user;
    public $tasks;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data; // รับข้อมูลสำหรับอีเมล
        // $this->user = $user;
        // $this->tasks = $tasks;
    }

    public function build()
    {
        return $this->subject('test case')
            ->view('emails.example'); // ใช้ Blade view
            // ->with('data', $this->data); // ส่งข้อมูลไปยัง view
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Task Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.example',
        );
    }

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
