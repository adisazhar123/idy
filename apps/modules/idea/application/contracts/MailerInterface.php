<?php

namespace Idy\Idea\Application\Contracts;

interface MailerInterface
{
    public function createMessage($to, $from, $subject, $body);
    public function sendMessage();
    public function setTemplate($template);
}