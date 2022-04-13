<?php
$currPage = 'front_Windows Server bestellen';
include 'app/controller/PageController.php';
include 'app/manager/customer/windows/order.php';
$product = $db->prepare("SELECT * FROM `windows_packs` WHERE `id` = :id");
$product->execute(array(":id" => $_GET['id']));
if($product->rowCount() == 1){
    $response = $product->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: ".$helper->url()."windows/order");
}


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
        
        <div class="row">

            <div class="col-lg-7">
                <div class="card card-body shadow mb-3">
                    <h5 class="mb-0">Überprüfe deine Bestellung</h5>
                    <hr class="hr-color">
                    <div class="col-lg-12">
                        <form>
                            <div class="row">
                                <div class="col-md 6">
                                    <ul class="list-unstyled mb-0 pl-0">
                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2"><i class="uil uil-check-circle align-middle"></i></span><?php if($response['vcores'] == 1){ echo "Kern: ".$response['vcores']; } else { echo "Kerne: ".$response['vcores']; }?></li>
                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2"><i class="uil uil-check-circle align-middle"></i></span>Arbeitsspeicher: <?= $response['ram'] ?></li>
                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2"><i class="uil uil-check-circle align-middle"></i></span>Speicher: <?= $response['disc'] ?> GB</li>
                                    </ul>
                                </div>
                                <br>
                                <div class="col-md 6">
                                    <ul class="list-unstyled mb-0 pl-0">
                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2"><i class="uil uil-check-circle align-middle"></i></span>IP-Adresse(n): 1</li>
                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2"><i class="uil uil-check-circle align-middle"></i></span>Standort: <?= $response['land'] ?></li>
                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2"><i class="uil uil-check-circle align-middle"></i></span>Laufzeit: <?= $response['laufzeit'] ?> Tage</li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-lg-5">
                <div class="card card-body shadow mb-3">
                    <h5 class="mb-0">Kostenübersicht</h5>

                    <hr class="hr-color">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tbody>
                            <tr>
                                <td class="h6 border-0">Heute fällig</td>
                                <td class="text-center border-0">
                                    
                                <?= $response['price'] ?>€

                                                                    </td>
                            </tr>
                        </tbody></table>
                        <hr class="hr-color">
                        <ul class="list-unstyled mt-4 mb-0">
                            <form method="post" id="orderForm">
                                <li>
                                    <div class="custom-control custom-switch" id="wiederruf_box">
                                        <input type="checkbox" class="custom-control-input" id="agb" name="agb">
                                        <label class="custom-control-label" for="agb"> Ich habe die <a href="<?= $helper->url(); ?>agb">AGB</a> und <a href="<?= $helper->url(); ?>datenschutz">Datenschutzerklärung</a> gelesen und akzeptiere diese.</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-switch" id="wiederruf_box">
                                        <input type="checkbox" class="custom-control-input" id="wiederruf" name="wiederruf">
                                        <label class="custom-control-label" for="wiederruf"> Ich wünsche die vollständige Ausführung der Dienstleistung vor Fristablauf des Widerufsrechts gemäß Fernabsatzgesetz. Die automatische Einrichtung und Erbringung der Dienstleistung führt zum Erlöschen des Widerrufsrechts.</label>
                                    </div>
                                </li>
                        </form></ul>

                        <div class="mt-4 pt-2">

                        <?php if($user->sessionExists($_COOKIE['session_token'])){ ?>
                                    <form method="post">
                                        <input hidden value="none" name="order">
                                        <input hidden value="<?= $response['plesk_id']; ?>" name="planName">
                                        <button onclick="orderNow();" id="orderBtn" type="submit" class="btn btn-primary" name="order">Kostenpflichtig bestellen</button>
                                    </form>
                                <?php } else { ?>
                                    <a href="<?= $helper->url(); ?>register" class="btn btn-primary">Account erstellen</a>
                                <?php } ?>   
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function orderNow() {
            if (document.getElementById("agb").checked) {
                if (document.getElementById("wiederruf").checked) {
                    document.getElementById("orderForm").submit();
                    const button = document.getElementById('orderBtn');
                    button.disabled = false;
                    button.innerHTML = 'Bestellung wird ausgeführt...';
                }
            }
        }
    </script>
    </section>