<?php

$id = $helper->protect($_GET['id']);

$SQLGetServerInfos = $db->prepare("SELECT * FROM `kvmserver` WHERE `id` = :id");
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


if(isset($_POST['StartKVM'])) {
    if(!($suspended == true)){

        $virtKVM->startKVM($serverInfos['node'], $serverInfos['virt_id']);

        echo sendSuccess('Dein KVM Server wird nun gestartet!');

        header('refresh:3;');
    }
}
    
    
if(isset($_POST['StopKVM'])) {
    if(!($suspended == true)){
    
        $virtKVM->stopKVM($serverInfos['node'], $serverInfos['virt_id']);
    
        echo sendSuccess('Dein KVM Server wird nun gestoppt!');

        header('refresh:3;');
    }
}
    
if(isset($_POST['RebootKVM'])) {
    if(!($suspended == true)){

        $virtKVM->rebootKVM($serverInfos['node'], $serverInfos['virt_id']);
    
        echo sendSuccess('Dein KVM Server wird nun neugestartet!');

        header('refresh:3;');
    }
}
    
if(isset($_POST['ChangeRootKey'])) {
    if(!($suspended == true)){
    
        $virtKVM->changeRootKey($serverInfos['node'], $serverInfos['virt_id'], $_POST['root_pw']);
    
        header('refresh:0;url='.$helper->url().'kvm/manage/'.$serverInfos['id']);
    }
}
    
if(isset($_POST['ChangeHostName'])) {
    if(!($suspended == true)){    

        $virtKVM->changeHOSTname($serverInfos['node'], $serverInfos['virt_id'], $_POST['hostname']);

        header('refresh:0;url='.$helper->url().'kvm/manage/'.$serverInfos['id']);
    }
}
    
if(isset($_POST['ReinstallKVM'])) {
    if(!($suspended == true)){

        $virtKVM->reinstallKVM($serverInfos['node'], $serverInfos['virt_id'], $_POST['osid']);
        header('refresh:0;url='.$helper->url().'kvm/manage/'.$serverInfos['id']);

    }
}

