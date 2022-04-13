<?php
$currPage = 'back_Rechnung';
include 'app/controller/PageController.php';

if (empty($_GET['id']) || !isset($_GET['id'])) {
    header('Location: ' . $url . 'zahlungsverlauf');
}

$invoice_id = $_GET['id'];

$SQL = $db->prepare("SELECT * FROM `transactions` WHERE `id` = :id");
$SQL->execute(array(":id" => $invoice_id));
$invoiceInfos = $SQL->fetch(PDO::FETCH_ASSOC);

if (!($userid == $invoiceInfos['user_id'])) {
    header('Location: ' . $url . 'zahlungsverlauf');
    die();
}

?>

<section class="section">
    <div class="container">
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">

            <div class="col-7 col-lg-7 col-xl-12">

                <div class="card card-body p-5">
                    <div class="row">
                        <div class="col text-right">

                            <div class="badge badge-success">
                                <?php if ($invoiceInfos['state'] == 'DONE') {
                                    echo 'Erfolgreich';
                                }
                                if ($invoiceInfos['state'] == 'PENDING') {
                                    echo 'Zahlung ausstehend';
                                }

                                if ($invoiceInfos['state'] == 'ABORT') {
                                    echo 'Abgebrochen';
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">

                            <img src="<?= $helper->cdnUrl(); ?>images/logo-light.png" alt="..." class="img-fluid mb-4"
                                 style="max-width: 220px;">

                            <h2 class="mb-2">
                                Guthabenaufladung
                            </h2>

                            <br>
                            <br>
                            <br>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">

                            <h6 class="text-uppercase text-muted">

                            <p class="text-muted mb-4">
                            Max Mustermann <br>
                            Musterstraße 21 <br>
                            87643 Musterdorf <br>
                                Deutschland
                            </p>

                            <h6 class="text-uppercase text-muted">
                                Rechnung
                            </h6>

                            <p class="mb-4">
                                #<?php echo $invoice_id; ?>
                            </p>

                        </div>
                        <div class="col-12 col-md-6 text-md-right">

                            <h6 class="text-uppercase text-muted">
                                Rechnung an
                            </h6>

                            <p class="text-muted mb-4">
                                <?= $username ?> 
                                <br>
                                <?= $mail ?>
                            </p>

                            <h6 class="text-uppercase text-muted">
                                Datum
                            </h6>

                            <p class="mb-4">
                                <time datetime="2018-04-23">
                                    <?php
                                    $date = new DateTime($invoiceInfos['created_at']);
                                    echo $date->format('d.m.Y H:i:s');
                                    ?>
                                </time>
                            </p>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">


                            <div class="table-responsive">
                                <table class="table my-4">
                                    <thead>
                                    <tr>
                                        <th class="px-0 bg-transparent border-top-0">
                                            <span class="h6">Beschreibung</span>
                                        </th>
                                        <th class="px-0 bg-transparent border-top-0">
                                            <span class="h6">Zahlungsmethode</span>
                                        </th>
                                        <th class="px-0 bg-transparent border-top-0 text-right">
                                            <span class="h6">Preis</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="px-0">
                                            <?php echo $invoiceInfos['desc']; ?>
                                        </td>
                                        <td class="px-0">
                                            <?php echo $invoiceInfos['gateway']; ?>
                                        </td>
                                        <td class="px-0 text-right">
                                            <?php echo $invoiceInfos['amount']; ?>€
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <hr class="my-5">


                        </div>
                    </div> <!-- / .row -->
                </div>

            </div>						


            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>