<?php
$currPage = 'back_vServer_admin';
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
                                            <th>Paket</th>
											<th>Hostname</th>
											<th>IP-Adresse</th>
                                            <th>Preis</th>
                                            <th>Status</th>
                                            <th>Laufzeit</th>
                                            <th> </th>
                                        </tr>
                                        </thead>
										<tbody>
<?php
            $SQL = $db->prepare("SELECT * FROM `vserver` WHERE `state` = 'active' OR `state` = 'suspended'");
            $SQL->execute(); 
            if ($SQL->rowCount() != 0) {
            while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){

            if($row['state'] == 'active'){
                $state = '<span class="badge badge-success">Aktiv</span>';
            } elseif($row['state'] == 'suspended'){
                $state = '<span class="badge badge-warning">Suspendiert</span>';
            } elseif($row['state'] == 'deleted'){
                $state = '<span class="badge badge-danger">Gelöscht</span>';
            } elseif($row['state'] == 'installing'){
                $state = '<span class="badge badge-warning">Installiere</span>';
            }
                ?>
                                        
                                           <tr>
                                              <td><?= $row['id']; ?></td>
											  <td><?= $user->getDataById($row['user_id'],'username'); ?></td>
                                              <td><?= $helper->protect($row['plan_id']); ?></td>
                                              <td><?= $helper->protect($row['hostname']); ?></td>
											  <td><?= $helper->protect($row['serv_ip']); ?></td>
                                              <td><?= $helper->protect($row['price']); ?>€</td>
											  <td><?= $state ?></td>
                                              <td><?= $helper->formatDate($row['expire_at']); ?></td>
                                              <td><a href="<?= $helper->url(); ?>team/vserver/<?= $row['id']; ?>"><button class="btn btn-outline-primary btn-sm"><i class="fas fa-pencil-alt"></i></button></a> </td>
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