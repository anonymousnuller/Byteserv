<?php
if(isset($_POST['login'])){
    $error = null;


    if(empty($_POST['password'])){
        $error = 'Bitte gebe ein Passwort an';
    }

    if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false){
        $error = 'Bitte gebe eine gültige E-Mail an';
    }

    if(!$user->verifyLogin($_POST['email'], $_POST['password'])){
        $error = 'Das angegebene Passwort stimmt nicht';
        include 'app/notifications/mail_templates/fail_password.php';
        $mail_state = sendMail($_POST['email'], $username, $mailContent, $mailSubject, $emailAltBody);
    
        if($mail_state != true){
            $error = 'Die E-Mail konnte nicht versendet werden';
        }

    }

    if($user->getState($_POST['email']) == 'pending'){
        $error = 'Bitte bestätige nun deine E-Mail';
    }

    if($user->getState($_POST['email']) == 'disabled'){
        $error = 'Dein Account ist deaktivert!';
    }

    if(empty($error)){

        $sessionId = $user->generateSessionToken($_POST['email']);
        setcookie('session_token', $sessionId,time()+'864000','/');

        $SQL = $db->prepare("UPDATE `users` SET `user_addr` = :user_addr WHERE `email` = :email");
        $SQL->execute(array(":user_addr" => $user->getIP(), ":email" => $_POST['email']));
        echo sendSuccess('Login erfolgreich. Du wirst gleich weitergeleitet');
        header('refresh:3;url='.$helper->url().'dashboard');

    } else {
        echo sendError($error);
    }
}