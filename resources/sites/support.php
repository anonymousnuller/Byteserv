<?php
$currPage = 'front_Support';
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

<section class="section bg-custom1">
    <div class="container">

        <div class="second-priceing-table text-center">
			<h3>Du benötigst Hilfe? <br>Hier kannst du uns erreichen:</h3>
			<div class="row">

                   <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="card pricing hosting-rate border-0 rounded overflow-hidden">
                            <div class="plan-name p-4 border-bottom">
                                <h5 class="title mb-3">» TeamSpeak-Support<span class="badge badge-success" style="float: right;">DE</span></h5>
								
                            </div>
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <span class="price text-primary h3 mb-0">Sprachsupport</span><br><br>
									<p>Durchschnittliche Wartezeit<br><b>60 Minuten</b></p>	
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="text-center">
									<a href="ts3server://hosting123.de" class="btn btn-primary">TeamSpeak betreten</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
				<div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="card pricing hosting-rate border-0 rounded overflow-hidden">
                            <div class="plan-name p-4 border-bottom">
                                <h5 class="title mb-3">» Ticket-Support <span class="badge badge-success" style="float: right;">DE & EN</span></h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <span class="price text-primary h3 mb-0">Schriftlicher Support</span><br><br>
									<p>Durchschnittliche Wartezeit<br><b>3 Stunden</b></p>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="text-center">
									<a href="<?= $helper->url(); ?>tickets" class="btn btn-primary">Ticket erstellen</a>
                                </div>
                            </div>
                        </div>
                    </div>
				<div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="card pricing hosting-rate border-0 rounded overflow-hidden">
                            <div class="plan-name p-4 border-bottom">
                                <h5 class="title mb-3">» Discord-Support <span class="badge badge-success" style="float: right;">DE & EN</span></h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <span class="price text-primary h3 mb-0">Schriftlicher Support</span><br><br>
									<p>Durchschnittliche Wartezeit<br><b>60 Minuten</b></p>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="text-center">
									<a href="https://discord.gg/nicehosting" class="btn btn-primary">Discord betreten</a>
                                </div>
                            </div>
                        </div>
                    </div>
			</div>
        </div>
		<br>
	</div>
</section>
<div class="position-relative">
            <div class="shape overflow-hidden text-footer">
                <svg viewBox="0 0 2880 250" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M720 125L2160 0H2880V250H0V125H720Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>