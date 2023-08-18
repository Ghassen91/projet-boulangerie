<?php

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{

    public function __construct(private MailerInterface $mailer)
    {

    }

    public function sendEmail(string $replyTo, string $to, string $subject, string $content, string $from): void
    {


        $email = (new Email())
            ->replyTo($replyTo)
            ->to($to)
            ->from($from)
            ->subject($subject)
            ->html($content);

        $this->mailer->send($email);
    }
}