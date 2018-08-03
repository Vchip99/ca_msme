<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class SendResume extends Mailable
{
    use Queueable, SerializesModels;

    public $request;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Resume from '.$this->request->name)
            ->view('emails.send_resume')
            ->with(['name' => $this->request->name,
                    'email' => $this->request->email,
                    'phone' => $this->request->phone,
                ])
            ->attach($this->request->resume->path(), [
                'as' => $this->request->resume->getClientOriginalName(),
                'mime' => 'application/pdf',
            ]);
    }
}
