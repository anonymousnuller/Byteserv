<?php

if(isset($_POST['order'])){
	$SQL = $db->prepare("SELECT * FROM `users` WHERE `id` = :id");
    $SQL->execute(array(':id' => $userid));
    $response = $SQL->fetch(PDO::FETCH_ASSOC);

    $error = null;
    
    if(!$user->sessionExists($_COOKIE['session_token'])){
        $error = 'Bitte logge dich erst ein';
    }

    if(empty($_POST['planName'])){
        $error = 'Es konnte kein Paket gefunden werden';
    }
	
    if(empty($response['amount'] >= $price)){
        $error = 'Du hast nicht genug Guthaben!';
    }

    if(empty($error)){

            $create = $virtLXC->createLXC($userid, $_POST['planName']);
            if($create == NULL){
                $_SESSION['success_msg'] = 'Vielen Dank! Dein KVM-Server wird nun eingerichtet!';
                header('Location: '.$helper->url().'dashboard');
            } else {
                echo sendError('Es ist ein Fehler aufgetreten ERROR:'.$create);
            }
        
    } else {
        print_r($error);
    }
}