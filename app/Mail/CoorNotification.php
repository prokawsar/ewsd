<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CoorNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $idea;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $idea)
    {
        $this->user = $user;
        $this->idea = $idea;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.coor');
    }
}
