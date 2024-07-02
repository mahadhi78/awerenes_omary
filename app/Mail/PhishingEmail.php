<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PhishingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $temp_name, $info, $info_id, $template_id;

    public function __construct($temp_name, $info, $info_id, $template_id)
    {
        $this->temp_name = $temp_name;
        $this->info = $info;
        $this->info_id = $info_id;
        $this->template_id = $template_id;
    }

    public function build()
    {
        return $this->view('mails.phishing')
            ->subject($this->temp_name)
            ->with([
                'subject' => $this->temp_name,
                'body' => $this->info,
                'info_id' => $this->info_id,
                'template_id' => $this->template_id,
            ]);
    }
}
