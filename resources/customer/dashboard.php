<?php
$currPage = 'back_Meine Produkte';
include 'app/controller/PageController.php';


if(isset($_POST['renewPin'])){
    $s_pin = $user->generateSupportPin($userid);
    echo sendSuccess('Support Pin wurde erneuert');
}
?>
<section class="bg-half bg-light d-table w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="page-next-level">
	                <h4 class="title" style="color:white;"><span class="wrap">Willkommen <?= $username ?> 👋</span></h4>
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
    <div class="container" style="margin-top: -80px; margin-bottom: -50px;">

    <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card features fea-primary rounded p-4 position-relative overflow-hidden border-0 bg-light"> 
                    <span class="h1 icon2 text-primary">
						<center><i class="fa fa-wallet" aria-hidden="true"></i></center>
                    </span>
                    <div class="card-body p-0 content">
						<center><h5><?= $amount ?> €</h5></center>
						<center><h6>Dein Guthaben</h6></center>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card features fea-primary rounded p-4 position-relative overflow-hidden border-0 bg-light">
                    <span class="h1 icon2 text-primary">
						<center><i class="fa fa-calendar-day" aria-hidden="true"></i></center>
                    </span>
                    <div class="card-body p-0 content">
						<center><h5><?= $user->monthCost($userid); ?>€</h5></center>
						<center><h6>Deine Monatlichen Kosten</h6></center>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card features fea-primary rounded p-4 position-relative overflow-hidden border-0 bg-light">
                    <span class="h1 icon2 text-primary">
						<center><i class="fa fa-cubes" aria-hidden="true"></i></center>
                    </span>
                    <div class="card-body p-0 content">
						<center><h5><?= $user->serviceCount($userid); ?></h5></center>
						<center><h6>Deine Aktive Dienste</h6></center>
                    </div>
                </div>
            </div>  
            <div class="col-md-3">
                <div class="card features fea-primary rounded p-4 position-relative overflow-hidden border-0 bg-light">
                    <span class="h1 icon2 text-primary">
						<center><i class="fas fa-ticket-alt" aria-hidden="true"></i></center>
                    </span>
                    <div class="card-body p-0 content">
						<center><h5><?= $user->getSupportPIN($userid); ?> <i style="cursor: pointer;" onclick="renew();" class="fas fa-sync-alt" data-toggle="tooltip" title="Neuen Support-PIN generieren"></i></h5></center>
						<center><h6>Dein Support-PIN</h6></center>
                    </div>
                </div>
            </div> 
            <form method="post" id="renewPin">
                                    <input hidden name="renewPin">
                                </form>

                                <script>
                                    function renew() {
                                        document.getElementById('renewPin').submit();
                                    }
                                </script> 
        </div>
        <br> 
        <center>
        <div class="col-md-8">
        <ul class="nav nav-pills nav-justified flex-column flex-sm-row rounded bg-light" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link rounded active" id="pills-vserver-tab" data-toggle="pill" href="#pills-vserver" role="tab" aria-controls="pills-vserver">vServer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded" id="pills-kvms-tab" data-toggle="pill" href="#pills-kvms" role="tab" aria-controls="pills-kvms">KVM Server</a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded" id="pills-webspace-tab" data-toggle="pill" href="#pills-webspace" role="tab" aria-controls="pills-webspace">WebSpace</a>
            </li>
        </ul>
    </div>
        </center>
        <div class="row">
            <div class="col-12 mt-4 pt-2">
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade active show" id="pills-vserver" role="tabpanel" aria-labelledby="pills-vserver-tab">
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-body text-center">
                                    <table id="dataTableDE" class="table table-center table-padding mb-0" style="color:white">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Paket</th>
											<th>Hostname</th>
											<th>IP-Adresse</th>
                                            <th>Status</th>
                                            <th>Laufzeit</th>
                                            <th> </th>
                                        </tr>
                                        </thead>
										<tbody>
                                        <?php
                                        $SQLv = $db->prepare("SELECT * FROM `vserver` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
                                        $SQLv->execute(array(":user_id" => $userid));
                                        if ($SQLv->rowCount() != 0) {
                                        while ($row = $SQLv -> fetch(PDO::FETCH_ASSOC)){
                                        if($row['state'] == 'active'){
                                            $state = '<span class="badge badge-success">Aktiv</span>';
                                        } elseif($row['state'] == 'suspended'){
                                            $state = '<span class="badge badge-warning">Abgelaufen</span>';
                                        } elseif($row['state'] == 'deleted'){
                                            $state = '<span class="badge badge-danger">Gelöscht</span>';
                                        } elseif($row['state'] == 'installing'){
                                            $state = '<span class="badge badge-warning">Installiere</span>';
                                        }
                                        ?>
                                           <tr>
                                              <td><?= $row['id']; ?></td>
                                              <td><?= $row['plan_id']; ?></td>
                                              <td><?= $row['hostname']; ?></td>
											  <td><?= $row['serv_ip']; ?></td>
											  <td><?= $state ?></td>
                                              <td><?= $helper->formatDate($row['expire_at']); ?></td>
                                              <td> <?php if($row['state'] == 'active'){ ?><a href="<?= $helper->url(); ?>vserver/manage/<?= $row['id']; ?>"><button class="btn btn-outline-primary btn-sm"><i class="fas fa-pencil-alt"></i></button></a><?php } elseif($row['state'] == 'suspended'){ ?> <a href="<?= $helper->url(); ?>kvm/renew/<?= $row['id']; ?>"><button class="btn btn-outline-primary btn-sm"><i class="fas fa-pencil-alt"></i></button></a> <?php } ?> </td>
                                        </tr>
                                        <?php } } ?>
                                        </tbody>
					                </table>
                                </div>
                            </div>
                        </div>
			        </div>


                    <div class="tab-pane fade" id="pills-kvms" role="tabpanel" aria-labelledby="pills-kvms-tab">
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-body text-center">
                                    <table id="dataTableDE" class="table table-center table-padding mb-0" style="color:white">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Paket</th>
											<th>Hostname</th>
											<th>IP-Adresse</th>
                                            <th>Status</th>
                                            <th>Laufzeit</th>
                                            <th> </th>
                                        </tr>
                                        </thead>
										<tbody>
                                        <?php
                                        $SQL = $db->prepare("SELECT * FROM `kvmserver` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
                                        $SQL->execute(array(":user_id" => $userid));
                                        if ($SQL->rowCount() != 0) {
                                        while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){

                                        if($row['state'] == 'active'){
                                            $state = '<span class="badge badge-success">Aktiv</span>';
                                        } elseif($row['state'] == 'suspended'){
                                            $state = '<span class="badge badge-warning">Abgelaufen</span>';
                                        } elseif($row['state'] == 'deleted'){
                                            $state = '<span class="badge badge-danger">Gelöscht</span>';
                                        } elseif($row['state'] == 'installing'){
                                            $state = '<span class="badge badge-warning">Installiere</span>';
                                        }
                                        ?>
                                            <tr>
                                              <td><?= $row['id']; ?></td>
                                              <td><?= $row['plan_id']; ?></td>
                                              <td><?= $row['hostname']; ?></td>
											  <td><?= $row['serv_ip']; ?></td>
											  <td><?= $state ?></td>
                                              <td><?= $helper->formatDate($row['expire_at']); ?></td>
                                              <td> <?php if($row['state'] == 'active'){ ?><a href="<?= $helper->url(); ?>kvm/manage/<?= $row['id']; ?>"><button class="btn btn-outline-primary btn-sm"><i class="fas fa-pencil-alt"></i></button></a><?php } elseif($row['state'] == 'suspended'){ ?> <a href="<?= $helper->url(); ?>kvm/renew/<?= $row['id']; ?>"><button class="btn btn-outline-primary btn-sm"><i class="fas fa-pencil-alt"></i></button></a> <?php } ?> </td>
                                            </tr>
  
                                        <?php } } ?>
                                        </tbody>
					                    </table>
                                </div>
                            </div>
                        </div>
			        </div>

                    <div class="tab-pane fade" id="pills-webspace" role="tabpanel" aria-labelledby="pills-webspace-tab">
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-body text-center">
                                    <table id="dataTableDE" class="table table-center table-padding mb-0" style="color:white">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Paket</th>
											<th>Domain</th>
                                            <th>Status</th>
                                            <th>Laufzeit</th>
                                            <th> </th>
                                        </tr>
                                        </thead>
										<tbody>
                                        <?php
                                        $SQL = $db->prepare("SELECT * FROM `webspace` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
                                        $SQL->execute(array(":user_id" => $userid));
                                        if ($SQL->rowCount() != 0) {
                                        while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){

                                        if($row['state'] == 'active'){
                                            $state = '<span class="badge badge-success">Aktiv</span>';
                                        } elseif($row['state'] == 'suspended'){
                                            $state = '<span class="badge badge-warning">Abgelaufen</span>';
                                        } elseif($row['state'] == 'deleted'){
                                            $state = '<span class="badge badge-danger">Gelöscht</span>';
                                        } elseif($row['state'] == 'installing'){
                                            $state = '<span class="badge badge-warning">Installiere</span>';
                                        }
                                        ?>
                                            <tr>
                                              <td><?= $row['id']; ?></td>
                                              <td><?= $row['plan_id']; ?></td>
                                              <td><?= $row['domainName']; ?></td>
											  <td><?= $state ?></td>
                                              <td><?= $helper->formatDate($row['expire_at']); ?></td>
                                              <td> <?php if($row['state'] == 'active'){ ?><a href="<?= $helper->url(); ?>webspace/manage/<?= $row['id']; ?>"><button class="btn btn-outline-primary btn-sm"><i class="fas fa-pencil-alt"></i></button></a><?php } elseif($row['state'] == 'suspended'){ ?> <a href="<?= $helper->url(); ?>kvm/renew/<?= $row['id']; ?>"><button class="btn btn-outline-primary btn-sm"><i class="fas fa-pencil-alt"></i></button></a> <?php } ?> </td>
                                            </tr>
  
                                        <?php } } ?>
                                        </tbody>
					                    </table>
                                </div>
                            </div>
                        </div>
			        </div>

<br><br><br><br><br>

                </div>
            </div>
        </div>
    </div>
</section>
<div class="position-relative">
            <div class="shape overflow-hidden text-footer">
                <svg viewBox="0 0 2880 250" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M720 125L2160 0H2880V250H0V125H720Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>