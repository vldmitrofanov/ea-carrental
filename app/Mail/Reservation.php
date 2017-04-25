<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reservation extends Mailable
{
    public $oReservation;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($oReservation)
    {
        $this->oReservation = $oReservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('hello@app.com', 'Your Application')
            ->subject('Event Reminder: ' . $this->oReservation->name)
            ->view('emails.reservation')
            ->with(['title' => $this->oReservation->name]);
    }
}
