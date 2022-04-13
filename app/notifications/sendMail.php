<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($user_email, $user_name, $mailContent, $mailSubject, $emailAltBody = null){

    include 'app/notifications/mail_templates/mail_style.php';

    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'e-mail.server.com';
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'noreply@nicedomain.eu';
        $mail->Password = 'lool';
        $mail->Port = 25;
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
           )
         );

        $mail->setFrom('noreply@nicedomain.eu', 'www.nicedomain.eu | Kundendienst');
        $mail->addAddress($user_email, $user_name);

        $mail->isHTML(true);
        $mail->Subject = $mailSubject;
        $mail->Body = $mailContent;
        $mail->AltBody = $emailAltBody;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
    }

}