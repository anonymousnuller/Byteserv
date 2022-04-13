<?php
$currPage = 'back_Webspace verwalten';
include 'app/controller/PageController.php';
include 'app/manager/customer/webspace/manage.php';
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

            <div class="col-md-5">
                <div class="card card-body panel-body text-center">

                    <h4 class="mb-0" style="color: white">Webspace #<?= $serverInfos['id']; ?></h4>

                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-muted mb-2 font-13">
                                <strong>Status:</strong>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <strong>Domain:</strong>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <strong>FTP User:</strong>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <strong>Preis:</strong>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <strong>Laufzeit:</strong>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-2 font-13">
                                <span class="ml-2"><?= $state; ?></span>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <span class="ml-2"><?= $serverInfos['domainName']; ?></span>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <span class="ml-2"><?= $serverInfos['ftp_name']; ?></span>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <span class="ml-2"><?= $serverInfos['price']; ?>€</span>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <span class="ml-2"><?= $helper->formatDate($serverInfos['expire_at']); ?></span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-7">
                <div class="card card-body panel-body text-center">
                    <h4 class="mb-0" style="color: white;">Logindaten</h4>
                    <br>

                    <div class="row">

                        <div class="col-md-6">
                            <label for="username" style="color: white;">Benutzername</label>
                            <input style="color:white;" class="form-control" id="username" disabled value="<?= $user->getDataBySession($_COOKIE['session_token'],'username'); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="password" style="color: white;">Passwort</label>
                            <input style="color:white;" class="form-control" disabled value="<?= $user->getDataBySession($_COOKIE['session_token'],'plesk_password'); ?>">
                        </div>

                        <div class="col-md-12">
                            <br>
                            <a target="_blank" class="btn btn-block btn-outline-primary" href="https://deinWebspace.lol">Zum Login</a>
                            <br>
                            <a class="btn btn-block btn-outline-success" href="<?= $helper->url(); ?>webspace/renew/<?= $id; ?>">Verlängern</a>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>