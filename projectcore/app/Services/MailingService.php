<?php
namespace App\Services;

use Illuminate\Mail\Mailer;

class MailingService
{
    protected $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function singleSend(string $to)
    {

    }

    public function bulkSend()
    {

    }
}