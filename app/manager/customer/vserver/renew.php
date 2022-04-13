<?php

$id = $helper->xssFix($_GET['id']);

$SQLGetServerInfos = $db->prepare("SELECT * FROM `kvmserver` WHERE `id` = :id");
$SQLGetServerInfos -> execute(array(":id" => $id));
$serverInfos = $SQLGetServerInfos -> fetch(PDO::FETCH_ASSOC);

$error = null;

if(!($serverInfos['deleted_at'] == NULL)){
    header('Location: '.$helper->url().'kvm/order');
}

if($userid != $serverInfos['user_id']){
    die(header('Location: '.$helper->url().'dashboard'));
}

if($serverInfos['state'] == 'suspended'){
    $suspended = true;
} else {
    $suspended = false;
}

if(isset($_POST['renew'])){

    $error = null;

    if(empty($_POST['duration'])){
        $error = 'Bitte wähle eine Laufzeit aus';
    }

    $price = $serverInfos['price'] * ($_POST['duration'] / 30);

    if($validate->duration($_POST['duration']) != true){
        $error = 'Bitte gebe eine gültige Laufzeit an';
    }

    if(empty($amount >= $price)){
        $error = 'Du hast nicht genug Guthaben!';
    }

    if(empty($error)){

        $date = new DateTime($serverInfos['expire_at'], new DateTimeZone('Europe/Berlin'));
        $date->modify('+' . $_POST['duration'] . ' day');
        $expire_at = $date->format('Y-m-d H:i:s');

        $newUserMoney = $amount - $price;
        $updateUserMoney = $db->prepare("UPDATE `users` SET `amount`=:newUserMoney WHERE `id` = :user_id");
        $updateUserMoney->execute(array(":newUserMoney" => $newUserMoney, ":user_id" => $userid));

        $SQLGetServerInfos = $db->prepare("UPDATE `kvmserver` SET `expire_at` = :expire_at, `state` = 'active' WHERE `id` = :id");
        $SQLGetServerInfos -> execute(array(":expire_at" => $expire_at, ":id" => $id));

        //$SQL2 = $db->prepare("INSERT INTO `user_transactions`(`user_id`, `art`, `amount`, `description`, `created_at`, `updated_at`) VALUES (?,?,?,?,?,?)");
        //$SQL2->execute(array($userid, 'RENEW', $price, 'KVM-Server - ' . $serverInfos['plan_id'], $date->format('Y-m-d H:i:s'), $date->format('Y-m-d H:i:s')));

        if($suspended == true){
            $rvserver->start($serverInfos['node'], $serverInfos['virt_id']);
        }
        echo sendSuccess('Dein KVM-Server wurde verlängert');

        header('refresh:3;url='.$helper->url().'kvm/manage/'.$serverInfos['id']);

    } else {
        echo sendError($error);
    }

}