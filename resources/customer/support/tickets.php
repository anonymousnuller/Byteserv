<?php
$currPage = 'back_Tickets';
include 'app/controller/PageController.php';

if(isset($_POST['createTicket'])){

        if (isset($_POST['title']) && !empty($_POST['title'])) {
            if (isset($_POST['category']) && !empty($_POST['category'])) {
                if (isset($_POST['priority']) && !empty($_POST['priority'])) {
                    if (isset($_POST['message']) && !empty($_POST['message'])) {


                        $DB_SQL = $db;
                        $SQL = $DB_SQL->prepare("INSERT INTO `tickets`(`user_id`, `categorie`, `priority`, `title`, `state`, `last_msg`) VALUES (:user_id,:categorie,:priority,:title,:status,:last_msg)");
                        $SQL->execute(array(":user_id" => $userid, ":categorie" => $_POST['category'], ":priority" => $_POST['priority'], ":title" => $_POST['title'], ":status" => 'OPEN', ":last_msg" => 'CUSTOMER'));
                        $ticket_id = $DB_SQL->lastInsertId();                    

                        if($mail_state != true){
                            $error = 'Die E-Mail konnte nicht versendet werden';
                        }

                        $SQL = $db->prepare("INSERT INTO `ticket_message`(`ticket_id`, `writer_id`, `message`) VALUES (:ticket_id,:writer_id,:message)");
                        $SQL->execute(array(":ticket_id" => $ticket_id, ":writer_id" => $userid, ":message" => $_POST['message']));

                        echo sendSuccess('Deine Anfrage wurde an das Team übermittelt');
                    }
                }
            }
        }

}

?>
<form method="post">
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Neues Ticket erstellen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Titel:</label>
                    <input style="color: white;" class="form-control bg-light" name="title" required="required">

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Kategorie:</label>
                            <select class="form-control bg-light" name="category" required="required" style="color: white;">
                                <option value="ALLGEMEIN">Allgemein</option>
                                <option value="TECHNIK">Technik</option>
                                <option value="BUCHHALTUNG">Buchhaltung</option>
                                <option value="PARTNER">Partnerschaft</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Priorität:</label>
                            <select class="form-control bg-light" name="priority" required="required" style="color: white;">
                                <option value="NORMAL">Normal</option>
                                <option value="MITTEL">Mittel</option>
                                <option value="HOCH">Hoch</option>
                            </select>
                        </div>
                    </div>

                    <br>

                    <label>Beschreibung:</label>
                    <textarea  style="color: white;" class="form-control bg-light" name="message" rows="5" required="required"></textarea>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Schließen</button>
                    <button type="submit" class="btn btn-outline-success" name="createTicket">Ticket erstellen</button>
                </div>
            </div>
        </div>
    </div>
</form>

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

        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">Neues Ticket erstellen</button>
        <br><br>
        <div class="row">

            <div class="col-md-12">
                <div class="card card-body panel-body">
                    <div class="card-body">

                        <table id="my_table" style="color:white" class="table table-nowrap">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Titel</th>
                                <th scope="col">Status</th>
                                <th scope="col">Letzte Antwort</th>
                                <th scope="col">Datum</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $SQL = $db -> prepare("SELECT * FROM `tickets` WHERE `user_id` = :user_id");
                            $SQL->execute(array(":user_id" => $userid));
                            if ($SQL->rowCount() != 0) {
                                while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){

                                    if($row['state'] == 'OPEN'){
                                        $status = '<span class="badge badge-success">Offen</span>';
                                    } elseif($row['state'] == 'CLOSED'){
                                        $status = '<span class="badge badge-danger">Geschlossen</span>';
                                    }

                                    if($row['last_msg'] == 'CUSTOMER'){
                                        $last_msg = '<span class="badge badge-secondary">Kundenantwort</span>';
                                    } elseif($row['last_msg'] == 'SUPPORT'){
                                        $last_msg = '<span class="badge badge-info">Supportantwort</span>';
                                    }

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $row['id']; ?></th>
                                        <th scope="row"><?= $helper->xssFix($row['title']); ?></th>
                                        <th scope="row"><?php echo $status; ?></th>
                                        <th scope="row"><?php echo $last_msg; ?></th>
                                        <td><?php echo $site->formatDate($row['created_at']); ?></td>
                                        <td><a href="<?php echo $helper->url(); ?>ticket/<?php echo $row['id']; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-pencil-alt"></i></a></td>
                                    </tr>
                                <?php } } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>