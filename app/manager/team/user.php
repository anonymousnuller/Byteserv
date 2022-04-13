<?php

$id = $helper->protect($_GET['id']);
$SQL = $db->prepare("SELECT * FROM `users` WHERE `id` = :id");
$SQL->execute(array(":id" => $id));
$userInfos = $SQL -> fetch(PDO::FETCH_ASSOC);

if(isset($_POST['updateUser'])){

    $SQL = $db->prepare("UPDATE `users` SET `username` = :username, `email` = :email, `state` = :state, `role` = :role WHERE `id` = :id");
    $SQL->execute(array(":username" => $_POST['username'], ":email" => $_POST['email'], ":state" => $_POST['state'], ":role" => $_POST['role'], ":id" => $id));

    echo sendSuccess('Benutzer wurde gespeichert');
    header('refresh:0;url='.$helper->url().'team/user/'.$userInfos['id']);
}

if(isset($_POST['changePassword'])){
    $error = null;

    if(empty($_POST['password'])){
        $error = 'Bitte gebe ein Passwort ein';
    }

    if($_POST['password'] != $_POST['password_repeat']){
        $error = 'Die Passwörter sind nicht gleich';
    }

    if(empty($error)){

        $cost = 10;
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => $cost]);

        $SQL = $db->prepare("UPDATE `users` SET `password` = :password WHERE `id` = :id");
        $SQL->execute(array(":password" => $password, ":id" => $id));
        echo sendSuccess('Password wurde geändert');

    } else {
        echo sendError($error);
    }
}
if(isset($_POST['changeVirt'])){
    $error = null;

    if(empty($error)){

        $SQLuser = $db->prepare("UPDATE `users` SET `virt_user` = :virt_user WHERE `id` = :id");
        $SQLuser->execute(array(":virt_user" => $_POST['virt_user'], ":id" => $userInfos['id']));
		$SQLpass = $db->prepare("UPDATE `users` SET `virt_pass` = :virt_pass WHERE `id` = :id");
		$SQLpass->execute(array(":virt_pass" => $_POST['virt_pass'], ":id" => $userInfos['id']));
        echo sendSuccess('Daten wurde geändert');
		header('refresh:0;url='.$helper->url().'team/user/'.$userInfos['id']);

    } else {
        echo sendError($error);
    }
}

if(isset($_POST['addguthaben'])){

$rechnen_add = $_POST['add_amount'] + $userInfos['amount'];

    $SQL = $db->prepare("UPDATE `users` SET `amount` = :amount WHERE `id` = :id");
    $SQL->execute(array(":amount" => $rechnen_add, ":id" => $id));

    $SQL = $db->prepare("INSERT INTO `user_transactions`(`user_id`, `art`, `amount`, `description`) VALUES (:user_id,'INTERN',:amount,:desc)");
    $SQL->execute(array(":user_id" => $userInfos['id'], ":amount" => $_POST['add_amount'], ":desc" => $_POST['add_amount_desc']));

    
    header('refresh:0;url='.$helper->url().'team/user/'.$userInfos['id']);
    echo sendSuccess('Guthaben wurde zugewiesen');
}

if(isset($_POST['remguthaben'])){

    $rechnen_rem = $userInfos['amount'] - $_POST['remove_amount'];
    
        $SQL = $db->prepare("UPDATE `users` SET `amount` = :amount WHERE `id` = :id");
        $SQL->execute(array(":amount" => $rechnen_rem, ":id" => $id));
    
        $SQL = $db->prepare("INSERT INTO `user_transactions`(`user_id`, `art`, `amount`, `description`) VALUES (:user_id,'INTERN',:amount,:desc)");
        $SQL->execute(array(":user_id" => $userInfos['id'], ":amount" => $_POST['remove_amount'], ":desc" => $_POST['remove_amount_desc']));
    
        
        header('refresh:0;url='.$helper->url().'team/user/'.$userInfos['id']);
        echo sendSuccess('Guthaben wurde erfolgreich entfernt!');
    }

?>