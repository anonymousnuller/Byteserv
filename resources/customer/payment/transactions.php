<?php
$currPage = 'back_TRANSAKTIONEN';
include 'app/controller/PageController.php';

?>
<section class="bg-half bg-light d-table w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="page-next-level">
	                <h4 class="title" style="color:white;"><span class="wrap"><?= $currPageName; ?></span></h4>
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
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                    
            <div class="col-md-12">
                <div class="card card-shadow">
                    <div class="card-header card-header-transparent">

                        <h4 class="text-center">Interne Transaktionen</h4>

                        <table style="color:white" class="table table-striped w-full dataTables_wrapper dt-bootstrap4 no-footer" id="table_id">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Aktion</th>
                                <th scope="col">Beschreibung</th>
                                <th scope="col">Preis</th>
                                <th scope="col">Datum</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $SQLSelectServers = $db->prepare("SELECT * FROM `user_transactions` WHERE `user_id` = :user_id ORDER BY `created_at` DESC");
                            $SQLSelectServers->execute(array(":user_id" => $userid));
                            if ($SQLSelectServers->rowCount() != 0) {
                                while ($row = $SQLSelectServers->fetch(PDO::FETCH_ASSOC)) {

                                    if ($row['art'] == 'RENEW') {
                                        $aktion = 'Verlängerung';
                                    } elseif ($row['art'] == 'ORDER') {
                                        $aktion = 'Bestellung';
                                    } elseif ($row['art'] == 'INTERN') {
                                        $aktion = 'Interne Transaktion';
                                    }

                                    ?>
                                    <tr class="bg-light">
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $aktion; ?></td>
                                        <td><?php echo $row['description']; ?></td>
                                        <td><?php echo $row['amount']; ?>€</td>
                                        <td><?php echo $row['created_at']; ?></td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
			<div class="col-md-3"><br><br><br></div>
            <div class="col-md-12">
                <div class="card card-shadow">
                    <div class="card-header card-header-transparent">

                        <h4 class="text-center">Guthaben Aufladungen</h4>

                        <table style="color:white" class="table table-striped w-full" id="guthaben_table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Status</th>
                                <th scope="col">Betrag</th>
                                <th scope="col">Datum</th>
                                <th scope="col">Rechnung</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $SQLSelectServers = $db->prepare("SELECT * FROM `transactions` WHERE `user_id` = :user_id");
                            $SQLSelectServers->execute(array(":user_id" => $userid));
                            if ($SQLSelectServers->rowCount() != 0) {
                                while ($row = $SQLSelectServers->fetch(PDO::FETCH_ASSOC)) {

                                    if ($row['state'] == 'DONE') {
                                        $status = '<span class="badge badge-success">Erfolgreich</span>';
                                    }
                                    if ($row['state'] == 'ABORT') {
                                        $status = '<span class="badge badge-danger">Abgebrochen</span>';
                                    }
                                    if ($row['state'] == 'PENDING') {
                                        $status = '<span class="badge badge-warning">Zahlung ausstehend</span>';
                                    }

                                    ?>
                                    <tr class="bg-light">
                                        <th scope="row"><?= $row['id']; ?></th>
                                        <td><?= $status; ?></td>
                                        <td><?= $row['amount']; ?>€</td>
                                        <td><?= $row['created_at']; ?></td>
                                        <td><a href="<?= $url; ?>payment/invoice/<?= $row['id']; ?>"
                                               class="btn btn-sm btn-primary"><i class="fas fa-file-invoice-dollar" aria-hidden="true"> Zur Rechnung</i></a></td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
						


            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
   
        $(document).ready(function() {
        $('#table_id').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/German.json"
            },
            "order": [ 0, 'desc' ]
        });
    } );

    $(document).ready(function() {
        $('#guthaben_table').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/German.json"
            },
            "order": [ 2, 'desc' ]
        });
    } );

    


</script>