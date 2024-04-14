<?php

namespace App\Helpers;

use CodeIgniter\Email\Email;

class EmailHelper
{
    protected Email $email;

    public function __construct()
    {
        $this->email = \Config\Services::email();

    }

    public function send_email($to, $from, $from_name, $subject, $message): bool
    {
        $this->email->setTo($to);
        $this->email->setFrom($from, $from_name);
        $this->email->setSubject($subject);
        $this->email->setMessage($message);

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }
}
