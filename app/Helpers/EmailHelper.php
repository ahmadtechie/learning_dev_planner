<?php

namespace App\Helpers;

use CodeIgniter\Email\Email;

class EmailHelper
{
    protected Email $email;

    public function __construct()
    {
        $this->email = new Email();
        $this->email->initialize(config('Email'));
    }

    public function send($to, $subject, $message)
    {
        $this->email->setTo($to);
        $this->email->setSubject($subject);
        $this->email->setMessage($message);

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function welcomeMessage($username, $password, $email, $login_url, $role): string
    {
        $data = [
          'username' => $username,
          'password' => $password,
          'email' => $email,
          'role' => $role,
          'login_url' => $login_url,
        ];
        return view('emails/welcome_email', $data);
    }
}
