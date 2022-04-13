<?php

$id = $helper->protect($_GET['id']);

$SQLGetServerInfos = $db->prepare("SELECT * FROM `vserver` WHERE `id` = :id");
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
    header('Location: '.$helper->url().'vserver/order');
}

if($serverInfos['state'] == 'suspended'){
    header('Location: '.$helper->url().'vserver/renew/'.$serverInfos['id']);
    $suspended = true;
} else {
    $suspended = false;
}

if($userid != $serverInfos['user_id']){
    die(header('Location: '.$helper->url().'dashboard'));
}


if(isset($_POST['StartLXC'])) {
    if(!($suspended == true)){

        $virtLXC->startLXC($serverInfos['virt_id']);

        echo sendSuccess('Dein vServer wird nun gestartet!');

        header('refresh:3;');
    }
}
    
    
if(isset($_POST['StopLXC'])) {
    if(!($suspended == true)){
    
        $virtLXC->stopLXC($serverInfos['virt_id']);
    
        echo sendSuccess('Dein vServer wird nun gestoppt!');

        header('refresh:3;');
    }
}
    
if(isset($_POST['RebootLXC'])) {
    if(!($suspended == true)){

        $virtLXC->rebootLXC($serverInfos['virt_id']);
    
        echo sendSuccess('Dein vServer wird nun neugestartet!');

        header('refresh:3;');
    }
}
    
if(isset($_POST['ChangeRootKey'])) {
    if(!($suspended == true)){
    
        $virtLXC->changeRootKey($serverInfos['virt_id'], $_POST['root_pw']);
    
        header('refresh:0;url='.$helper->url().'kvm/manage/'.$serverInfos['id']);
    }
}
    
if(isset($_POST['ChangeHostName'])) {
    if(!($suspended == true)){    

        $virtLXC->changeHOSTname($serverInfos['virt_id'], $_POST['hostname']);

        header('refresh:0;url='.$helper->url().'kvm/manage/'.$serverInfos['id']);
    }
}
    
if(isset($_POST['ReinstallLXC'])) {
    if(!($suspended == true)){

        $virtLXC->reinstallLXC($serverInfos['virt_id'], $_POST['osid']);
        header('refresh:0;url='.$helper->url().'kvm/manage/'.$serverInfos['id']);

    }
}

