<?php

if(isset($_POST['order'])){

    $error = null;
    $price = $plesk->getPrice($_POST['planName']);
    $price = number_format($price,2);

    if(!$user->sessionExists($_COOKIE['session_token'])){
        $error = 'Bitte logge dich erst ein';
    }

    if(empty($_POST['planName'])){
        $error = 'Es konnte kein Webspace Paket gefunden werden';
    }

    if($plesk->getPrice($_POST['planName']) == false){
        $error = 'Es konnte kein Webspace Paket mit diesem Namen gefunden werden';
    }

    if(empty($amount >= $price)){
        $error = 'Du hast nicht genug Guthaben!';
    }

    if(empty($error) && is_null($user->getDataBySession($_COOKIE['session_token'],'plesk_uid'))){
        $password = $helper->generateRandomString(25,'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!*?_#^/$%@');
        $plesk_uid = $plesk->createUser($username, $username, $password, $mail);
        if(is_numeric($plesk_uid)){
            $SQL = $db->prepare("UPDATE `users` SET `plesk_uid` = :plesk_uid, `plesk_password` = :plesk_password WHERE `id` = :user_id");
            $SQL->execute(array(":plesk_uid" => $plesk_uid, ":plesk_password" => $password, ":user_id" => $userid));
        } else {
            $error = $plesk_uid;
        }
    }

    if(empty($error)){

        $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
        $date->modify('+30 day');
        $new_date = $date->format('Y-m-d H:i:s');

        $pleskid = $helper->generateRandomString(3,'0123456789');

        $password = $helper->generateRandomString(25,'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!*?_#^/$%@');
        $plesk_uid = $user->getDataBySession($_COOKIE['session_token'],'plesk_uid');
        $domainName = 'web'.$pleskid.'.'.$plesk->getHost()['domainName'];
        $ftp_username = strtolower('ftp_'.$pleskid.'_'.$username.$plesk->getLast());

        $webspaceId = $plesk->create($domainName, $plesk->getHost()['ip'], $plesk_uid, $ftp_username, $password, $_POST['planName']);

        if(is_numeric($webspaceId)){
            $SQL = $db->prepare("INSERT INTO `webspace`(`plan_id`, `user_id`, `ftp_name`, `ftp_password`, `domainName`, `webspace_id`, `state`, `expire_at`, `price`) VALUES (?,?,?,?,?,?,?,?,?)");
            $SQL->execute(array($_POST['planName'], $userid, $ftp_username, $password, $domainName, $webspaceId, 'active', $new_date, $price));

			$newUserMoney = $amount - $price;
			$updateUserMoney = $db->prepare("UPDATE `users` SET `amount`=:newUserMoney WHERE `id` = :user_id");
			$updateUserMoney->execute(array(":newUserMoney" => $newUserMoney, ":user_id" => $userid));

            $SQL2 = $db->prepare("INSERT INTO `user_transactions`(`user_id`, `art`, `amount`, `description`, `created_at`, `updated_at`) VALUES (?,?,?,?,?,?)");
            $SQL2->execute(array($userid, 'ORDER', $price, 'WebSpace - ' . $_POST['planName'], $date->format('Y-m-d H:i:s'), $date->format('Y-m-d H:i:s')));

            $_SESSION['success_msg'] = 'Vielen Dank! Dein Webspace wird nun eingerichtet';

            header('Location: '.$helper->url().'dashboard');
        } else {
            echo sendError($webspaceId);
        }
    } else {
        echo sendError($error);
    }

}