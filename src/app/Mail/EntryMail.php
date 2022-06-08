<?php

namespace App\Mail;

use App\Entrie;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EntryMail extends Mailable
{
    use Queueable, SerializesModels;
    private $entry;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Entrie $entry)
    {
        $this->entry = $entry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('general_view.emails_template.email_template_for_mailing', $this->entry->toArray());
    }
}
