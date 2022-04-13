<?php
$currPage = 'front_KVM Rootserver bestellen';
include 'app/controller/PageController.php';
include 'app/manager/customer/kvm/order.php';
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

<section class="section bg-custom1">
    <div class="container">

        <div class="second-priceing-table text-center">
            <div class="row">

                <?php
                $SQL = $db->prepare("SELECT * FROM `kvm_packs`");
                $SQL->execute();
                if ($SQL->rowCount() != 0) {
                while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){
                    if($row['ram'] < 1024){
                        $ram = $row['ram'].' MB';
                    } else {
                        $ram = ($row['ram']/1024).' GB';
                    }
                ?>
                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                <div class="card explore-feature shadow bg-light rounded border-0">
                    <div class="card-body py-5">
                    <h4 class="title text-uppercase mb-4"><span class="badge rounded-pill bg-primary me-1 h6"><?= $row['name'] ?></span></h4>                        <div class="d-flex justify-content-center mb-4">
                            <span class="h4 mb-0 mt-2">€</span>
                            <span class="price h1 mb-0"><?= $row['price']; ?></span>
                            <span class="h4 align-self-end mb-1" style="font-size: small">&nbsp;/<?= $row['laufzeit'] ?> Tage</span>
                        </div>
                        <br>
                        <ul class="list-unstyled mb-0 pl-0">
                            <li class="h6 text-muted mb-0">
                                <i class="fas fa-map-marker-alt" aria-hidden="true"></i> <?= $row['location']; ?>
                            </li>
                            <li class="h6 text-muted mb-0">
                                <i class="fas fa-microchip" aria-hidden="true"></i> <?= $row['cores']; ?> vCores
                            </li>
                            <li class="h6 text-muted mb-0">
                                <i class="fas fa-memory" aria-hidden="true"></i> <?= $ram; ?> RAM
                            </li>
                            <li class="h6 text-muted mb-0">
                                <i class="fas fa-hdd" aria-hidden="true"></i> <?= $row['disc']; ?> GB Speicher
                            </li>
                            <li class="h6 text-muted mb-0">
                                <i class="fas fa-shield-alt" aria-hidden="true"></i> Voxility DDoS Protection
                            </li>
                            <li class="h6 text-muted mb-0">
                                <i class="fas fa-wifi" aria-hidden="true"></i> Fair Use (Traffic)
                            </li>
                        </ul>

                        <br>

                        <?php if($user->sessionExists($_COOKIE['session_token'])){ ?>
                                    <form method="post">
                                        <input hidden value="none" name="order">
                                        <input hidden value="<?= $row['name']; ?>" name="planName">
                                        <button onclick="orderNow();" id="orderBtn" type="submit" class="btn btn-success" name="order">Jetzt bestellen</button>
                                    </form>
                                <?php } else { ?>
                                    <a href="<?= $helper->url(); ?>register" class="btn btn-primary">Account erstellen</a>
                                <?php } ?>                        
                    </div>
                </div>
            </div>



                <?php } } ?>

                <script>
                    function orderNow() {
                        document.getElementById("orderForm").submit();
                        const button = document.getElementById('orderBtn');
                        button.disabled = false;
                        button.innerHTML = 'Bestellung wird ausgeführt...';
                    }
                </script>

            </div>
        </div>

    </div>
</section>
