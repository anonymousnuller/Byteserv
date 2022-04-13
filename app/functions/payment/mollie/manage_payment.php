<?php

if(isset($_POST['payNow'])){
        if($_POST['amount'] >= $min_payment && $_POST['amount'] <= $max_payment && is_numeric($_POST['amount'])){


            //$betrag = $_POST['amount'] / 100 * (100 - 15);

            $fields = array(
                'amount' => $_POST['amount'],
                'description' => 'Guthabenaufladung KD-NR: ' . $userid,
                'redirectUrl' => $url.'payment/charge',
            );

            $headers = array();
            $headers[] = "Authorization: Bearer ".$mollieAPIKEY;

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL,"https://api.mollie.com/v1/payments");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);

            $output = curl_exec($ch);

            curl_close ($ch);

            $response = json_decode($output);
            $tid = $response->id;

            $SQL = $db->prepare("INSERT INTO `transactions`(`user_id`, `gateway`, `state`, `amount`, `desc`, `tid`) VALUES (:user_id,:gateway,'PENDING',:amount,'Guthabenaufladung mit Mollie',:tid)");
            $SQL->execute(array(":user_id" => $userid, ":gateway" => 'Mollie', ":amount" => $_POST['amount'], ":tid" => $tid));

            header('Location: '.$response->links->paymentUrl);

        } else {
            echo sendError('Du musst mindestens ' . $min_payment . '€ Aufladen.');
        }

}

$SQLSelectServers = $db -> prepare("SELECT * FROM `transactions` WHERE `user_id` = :user_id AND `state` = 'PENDING' AND `gateway` = 'Mollie'");
$SQLSelectServers->execute(array(":user_id" => $userid));
if ($SQLSelectServers->rowCount() != 0) {
    while ($row = $SQLSelectServers -> fetch(PDO::FETCH_ASSOC)){

        $headers = array();
        $headers[] = "Authorization: Bearer ".$mollieAPIKEY;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"https://api.mollie.com/v1/payments/" . $row['tid']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $output = curl_exec($ch);

        curl_close ($ch);

        $response = json_decode($output);

        $status = $response->status;
        $SQL = $db -> prepare("SELECT * FROM `transactions` WHERE `id` = :id");
        $SQL -> execute(array(":id" => $row['id']));
        $paymentInfos = $SQL -> fetch(PDO::FETCH_ASSOC);

        if($status == 'paid'){
            $money = $paymentInfos['amount'];

            $SQL = $db -> prepare("UPDATE `transactions` SET `state` = 'DONE' WHERE `id` = :id");
            $SQL -> execute(array(":id" => $row['id']));

			$newUserMoney = $money + $amount;
            $updateUserMoney = $db->prepare("UPDATE `users` SET `amount` = :newUserMoney WHERE `id` = :user_id");
            $updateUserMoney->execute(array(":newUserMoney" => $newUserMoney, ":user_id" => $userid));

/*             include 'app/mail/mail_templates/amount_added.php';
            sendMail($_SESSION['email'], $_SESSION['username'], $mailContent, $mailSubject, $emailAltBody, '', ''); */
            echo sendSuccess('Guthaben aufgeladen');

            //TODO


        } else if($status == 'cancelled'){

            $SQL = $db -> prepare("UPDATE `transactions` SET `state` = 'ABORT' WHERE `id` = :id");
            $SQL -> execute(array(":id" => $row['id']));


/*             include 'app/mail/mail_templates/amount_added.php';
            sendMail($_SESSION['email'], $_SESSION['username'], $mailContent, $mailSubject, $emailAltBody, '', ''); */

            echo sendError('Guthabenaufladung abgebrochen');

            //TODO

        } else if($status == 'pending'){

            $SQL = $db -> prepare("UPDATE `transactions` SET `state` = 'PENDING' WHERE `id` = :id");
            $SQL -> execute(array(":id" => $row['id']));


/*             include 'app/mail/mail_templates/amount_added.php';
            sendMail($_SESSION['email'], $_SESSION['username'], $mailContent, $mailSubject, $emailAltBody, '', ''); */

            echo sendError('Warte auf Zahlungseingang');

            //TODO

        }       

    }
}