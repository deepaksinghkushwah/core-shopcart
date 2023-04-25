<?php
class Mailer
{
    public static function sendEmail(string $to, string $subject, string $message)
    {
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        // Additional headers
        //$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
        $headers[] = 'From: Super Admin <admin@localhost.com>';
        $headers[] = 'Cc: admin@localhost.com';
        //$headers[] = 'Bcc: birthdaycheck@example.com';
        mail($to, $subject, $message, implode("\r\n", $headers));
    }
}
