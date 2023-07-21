<?php

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    public function __construct(private MailerInterface $mailer)
    {

    }

    public function sendEmail(string $subject, string $content, string $from): void
    {
        $email = (new Email())
            ->from($from)
            ->subject($subject)
            ->html($content);

        $this->mailer->send($email);
    }
}