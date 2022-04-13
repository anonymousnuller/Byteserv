<?php

$id = $helper->protect($_GET['id']);

$SQLGetServerInfos = $db->prepare("SELECT * FROM `kvm` WHERE `id` = :id");
$SQLGetServerInfos -> execute(array(":id" => $id));
$serverInfos = $SQLGetServerInfos -> fetch(PDO::FETCH_ASSOC);

if($serverInfos['state'] == 'active'){
    $state = '<span class="badge badge-success">Aktiv</span>';
} elseif($serverInfos['state'] == 'suspended'){
    $state = '<span class="badge badge-warning">Suspendiert</span>';
} elseif($serverInfos['state'] == 'deleted'){
    $state = '<span class="badge badge-danger">Gelöscht</span>';
}


if(!($serverInfos['deleted_at'] == NULL)){
    header('Location: '.$helper->url().'kvm/order');
}

if($serverInfos['state'] == 'suspended'){
    header('Location: '.$helper->url().'kvm/renew/'.$serverInfos['id']);
    $suspended = true;
} else {
    $suspended = false;
}

if($userid != $serverInfos['user_id']){
    die(header('Location: '.$helper->url().'dashboard'));
}


$expire = $serverInfos['expire_at'];
$expire = strtotime($expire);

$oldExpiredate = date('Y-m-d', $expire);
$oldExpiretime = date('H:i:s', $expire);
$expireat = $oldExpiredate.'T'.$oldExpiretime;

if(isset($_POST['StartKVM'])) {
    if(!($suspended == true)){

        $virtKVM->startKVM($serverInfos['virt_id']);

        echo sendSuccess('Der Server wird nun gestartet!');

        header('refresh:3;');
    }
}
    
    
if(isset($_POST['StopKVM'])) {
    if(!($suspended == true)){
    
        $virtKVM->stopKVM($serverInfos['virt_id']);
    
        echo sendSuccess('Der Server wird nun gestoppt!');

        header('refresh:3;');
    }
}
    
if(isset($_POST['RebootKVM'])) {
    if(!($suspended == true)){

        $virtKVM->rebootKVM($serverInfos['virt_id']);
    
        echo sendSuccess('Der Server wird nun neugestartet!');

        header('refresh:3;');
    }
}

if(isset($_POST['DeleteKVM'])) {
    if(!($suspended == true)){    

        $virtKVM->deleteKVM($serverInfos['virt_id']);

        header('refresh:0;url='.$helper->url().'kvm/manage/'.$serverInfos['id']);
    }
}

if(isset($_POST['ChangeRootKey'])) {
    if(!($suspended == true)){
    
        $virtKVM->changeRootKey($serverInfos['virt_id'], $_POST['root_pw']);
    
        header('refresh:0;url='.$helper->url().'kvm/manage/'.$serverInfos['id']);
    }
}
    
if(isset($_POST['ChangeHostName'])) {
    if(!($suspended == true)){    

        $virtKVM->changeHOSTname($serverInfos['virt_id'], $_POST['hostname']);

        header('refresh:0;url='.$helper->url().'kvm/manage/'.$serverInfos['id']);
    }
}
    
if(isset($_POST['ReinstallKVM'])) {
    if(!($suspended == true)){

        $virtKVM->reinstallKVM($serverInfos['virt_id'], $_POST['osid']);
        header('refresh:0;url='.$helper->url().'kvm/manage/'.$serverInfos['id']);

    }
}

if(isset($_POST['ChangePrice'])) {
    if(!($suspended == true)){

        $SQL = $db->prepare("UPDATE `vserver` SET `price`=:newprice WHERE `id` = :id");
        $SQL->execute(array(":newprice" => $_POST['newprice'], ":id" => $serverInfos['id']));

        echo sendSuccess('Preis wurde geändert!');
        header('refresh:3;');

    }
}

if(isset($_POST['ChangeExpire'])) {
    if(!($suspended == true)){

        $newexpire = $_POST['expire'];
        $newexpire = strtotime($newexpire);
        $newDate = date('Y-m-d H:i:s', $newexpire);

        $SQL = $db->prepare("UPDATE `vserver` SET `expire_at`=:expire WHERE `id` = :id");
        $SQL->execute(array(":expire" => $newDate, ":id" => $serverInfos['id']));

        echo sendSuccess('Ablaufdatum wurde geändert!');
        header('refresh:3;');

    }
}


