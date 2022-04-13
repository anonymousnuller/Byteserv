<?php
$currPage = 'back_Tickets_admin';
include 'app/controller/PageController.php';

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
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><?= $currPageName ?></h3>
                                </div>
                                <div class="card card-body text-center">
                                    <table id="dataTableDE" style="color:white;" class="table table-center table-padding mb-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
											<th>Kunde</th>
                                            <th>Titel</th>
                                            <th>Status</th>
                                            <th>Letzte Antwort</th>
                                            <th>Datum</th>
                                            <th> </th>
                                        </tr>
                                        </thead>
										<tbody>
<?php
            $SQL = $db->prepare("SELECT * FROM `tickets`");
            $SQL->execute(); 
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
                                            <th><?= $row['id']; ?></th>
                                            <th><?= $user->getDataById($row['user_id'],'username'); ?></th>
                                            <th><?= $helper->xssFix($row['title']); ?></th>
                                            <th><?= $status; ?></th>
                                            <th><?= $last_msg; ?></th>
                                            <td><?=  $site->formatDate($row['created_at']); ?></td>
                                            <td><a href="<?= $helper->url(); ?>team/ticket/<?= $row['id']; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-pencil-alt"></i></a></td>
                                        </tr>
  
			<?php } } ?>
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
</section>