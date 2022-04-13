<?php
$currPage = 'front_Webspace bestellen';
include 'app/controller/PageController.php';
include 'app/manager/customer/webspace/order.php';
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


<section class="section bg-custom1">
    <div class="container">

        <div class="second-priceing-table text-center">
            <div class="row">

                <?php
                $SQL = $db->prepare("SELECT * FROM `webspace_packs`");
                $SQL->execute();
                if ($SQL->rowCount() != 0) {
                while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){
                ?>
                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="card explore-feature shadow bg-light rounded border-0">
                            <div class="card-body py-5">
                                <h4 class="title text-uppercase mb-4"><span class="badge rounded-pill bg-primary me-1 h6"><?= $row['plesk_id'] ?></span></h4>                        
                                <div class="d-flex justify-content-center mb-4">
                                    <span class="h4 mb-0 mt-2">€</span>
                                    <span class="price h1 mb-0"><?= $row['price']; ?></span>
                                    <span class="h4 align-self-end mb-1" style="font-size: small">&nbsp;/30 Tage</span>
                                </div>
                                <br>
                                <ul class="list-unstyled mb-0 pl-0">
                                    <li class="h6 text-muted mb-0">
                                        <i class="mdi mdi-arrow-right text-primary mr-2"></i> <?= $row['disc']; ?> GB Speicher
                                    </li>
                                    <li class="h6 text-muted mb-0">
                                        <i class="mdi mdi-arrow-right text-primary mr-2"></i> <?= $row['domains']; ?> Domains
                                    </li>
                                    <li class="h6 text-muted mb-0">
                                        <i class="mdi mdi-arrow-right text-primary mr-2"></i> <?= $row['subdomains']; ?> Subdomains
                                    </li>
                                    <li class="h6 text-muted mb-0">
                                        <i class="mdi mdi-arrow-right text-primary mr-2"></i> <?= $row['databases']; ?> Datenbanken
                                    </li>
                                    <li class="h6 text-muted mb-0">
                                        <i class="mdi mdi-arrow-right text-primary mr-2"></i> <?= $row['ftp_accounts']; ?> FTP-Accounts
                                    </li>
                                    <li class="h6 text-muted mb-0">
                                        <i class="mdi mdi-arrow-right text-primary mr-2"></i> <?= $row['emails']; ?> E-Mails
                                    </li>
                                </ul>
                                <br>

                        <?php if($user->sessionExists($_COOKIE['session_token'])){ ?>
                                    <form method="post">
                                        <input hidden value="none" name="order">
                                        <input hidden value="<?= $row['plesk_id']; ?>" name="planName">
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
            <br>
        </div>

    </div>
</section>
