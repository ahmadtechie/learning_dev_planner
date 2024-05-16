<?php

namespace App\Helpers;

use CodeIgniter\Email\Email;
use Config\Services;
use Exception;

class EmailHelper
{
    protected Email $email;

    public function __construct()
    {
        $this->email = Services::email();

    }

    public function send_email($to, $from, $from_name, $subject, $message): bool
    {
        set_time_limit(60);

        $this->email->setTo($to);
        $this->email->setFrom($from, $from_name);
        $this->email->setSubject($subject);
        $this->email->setMessage($message);

        try {
            if ($this->email->send()) {
                return true;
            } else {
                log_message('error', 'Email sending failed.');
                return false;
            }
        } catch (Exception $e) {
            log_message('error', 'Email sending failed: ' . $e->getMessage());
            return false;
        }
    }
}
