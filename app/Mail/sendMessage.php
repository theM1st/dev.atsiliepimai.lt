<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.pages.sendMessage')
            ->subject($this->data['subject'])
            ->with([
                'name' => $this->data['name'],
                'email' => $this->data['email'],
                'telephone' => $this->data['telephone'],
                'subject' => $this->data['subject'],
                'content' => $this->data['message'],
            ]);
    }
}
