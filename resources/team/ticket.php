<?php
$currPage = 'team_Ticket Support';
include 'app/controller/PageController.php';

$ticket_id = $helper->protect($_GET['id']);
$SQL = $db->prepare("SELECT * FROM `tickets` WHERE `id` = :ticket_id");
$SQL->execute(array(":ticket_id" => $ticket_id));
$ticketInfos = $SQL -> fetch(PDO::FETCH_ASSOC);

if($userid != $ticketInfos['user_id']){
    die(header('Location: '.$helper->url().'tickets'));
}

if($ticketInfos['state'] == 'OPEN'){
    $status = '<span class="badge badge-success">Geöffnet</span>';
} elseif($ticketInfos['state'] == 'CLOSED'){
    $status = '<span class="badge badge-danger">Geschlossen</span>';
}

if($ticketInfos['last_msg'] == 'CUSTOMER'){
    $last_msg = '<span class="badge badge-secondary">Kundenantwort</span>';
} elseif($ticketInfos['last_msg'] == 'SUPPORT'){
    $last_msg = '<span class="badge badge-info">Supportantwort</span>';
}

$writer_id = $userid;

if(isset($_POST['answerTicket'])){
    if (isset($_POST['message']) && !empty($_POST['message'])) {      

        $SQL = $db->prepare("INSERT INTO `ticket_message`(`ticket_id`, `writer_id`, `message`) VALUES (:ticket_id,:writer_id,:message)");
        $SQL->execute(array(":ticket_id" => $ticket_id, ":writer_id" => $writer_id, ":message" => $_POST['message']));

        $SQL = $db->prepare("UPDATE `tickets` SET `last_msg` = 'SUPPORT' WHERE `id` = :id");
        $SQL->execute(array(":id" => $ticket_id));

        echo sendSuccess('Antwort übermittelt');
        header('refresh:3');
    }
}

if(isset($_POST['closeTicket'])){
        
    $SQL = $db->prepare("UPDATE `tickets` SET `state` = 'CLOSED' WHERE `id` = :id");
    $SQL->execute(array(":id" => $ticket_id));

    echo sendSuccess('Ticket geschlossen!');
    header('refresh:3');
}

?>
<section class="bg-half bg-light d-table w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="page-next-level">
	                <h4 class="title" style="color:white;"><span class="wrap"><?= $currPageName ?></span></h4>
                </div>
            </div> 
        </div>
    </div> 
</section>
<div class="position-relative">
    <div class="shape overflow-hidden text-white">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
        </svg>
    </div>
</div>

<section class="section">
    <div class="container">

        <div class="row">

            <div class="col-md-12">
                <div class="card card-body panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            Ticket-ID: #<?= $ticket_id; ?>
                        </div>
                        <div class="col-md-3">
                            Status: <?= $status; ?>
                        </div>
                        <div class="col-md-3">
                            Letzte Antwort: <?= $last_msg; ?>
                        </div>
                        <div class="col-md-4">
                            Erstellt am: <?= $ticketInfos['created_at']; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12"> <br> </div>

            <?php
            $SQL = $db -> prepare("SELECT * FROM `ticket_message` WHERE `ticket_id` = :ticket_id");
            $SQL->execute(array(":ticket_id" => $ticket_id));
            if ($SQL->rowCount() != 0) {
                while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){
                    $writer_token = $user->getDataById($row['writer_id'],'session_token');
                    if($user->isInTeam($writer_token) == true){ ?>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="card card-body panel-body">
                                <p><?= $helper->xssFix($row['message']); ?></p>
                                <small style="float: right;"><?= $user->getDataById($row['writer_id'], 'username'); ?> schrieb am <?= $row['created_at']; ?></small>
                            </div>
                        </div>
                        <div class="col-md-12"> <br> </div>
                    <?php } else { ?>
                        <div class="col-md-6">
                            <div class="card card-body panel-body">
                                <p><?= $helper->xssFix($row['message']); ?></p>
                                <small style="float: right;"><?= $user->getDataById($row['writer_id'], 'username'); ?> schrieb am <?= $row['created_at']; ?></small>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-12"> <br> </div>
                    <?php } } } ?>

            <?php if($ticketInfos['state'] == 'OPEN'){ ?>
                <div class="col-md-12">
                    <form method="post">
                        <textarea style="color: white;" rows="10" name="message" class="form-control bg-light"></textarea>
                        <br>
                        <button type="submit" name="answerTicket" class="btn btn-outline-success">Antworten</button>
                        <?php if($ticketInfos['state'] == 'OPEN'){ ?>
                        <button style="float: right;" type="submit" name="closeTicket" class="btn btn-outline-danger">Ticket schließen</button>
                        <?php } ?>
                    </form>
                </div>
            <?php } else { ?>
                <center>Dieses Ticket ist geschlossen.</center>
            <?php } ?>

        </div>
    </div>
</section>