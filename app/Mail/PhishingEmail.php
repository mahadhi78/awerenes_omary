<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PhishingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $temp_name;
    public $info;

    public function __construct($temp_name, $info)
    {
        $this->temp_name = $temp_name;
        $this->info = $info;
    }

    public function build()
    {
        return $this->view('mails.phishing')
                    ->subject($this->temp_name)
                    ->with([
                        'subject' => $this->temp_name,
                        'body' => $this->info,
                    ]);
    }
}
