<?php
$currPage = 'back_Guthaben';
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
		
        <?php

        if (!empty($message)) {
            echo '<div class="alert alert-success" role="alert">' . $message . '</div>';
        }

                $min_payment = '1';
                $max_payment = '300';

                include 'app/functions/payment/mollie/manage_payment.php';

        ?>			
<div class="col-md-12">		
		<div class="card card-body bg-light">
		                                <h3 class="card-title text-center">Guthaben aufladen</h3>
				<h6 class="text-center">Dein Guthaben: <?= $amount; ?>€</h6>
			<form method="post">

                        <input style="color: white;" id="amount" class="form-control bg-light" value="2.50" onkeyup="update();" name="amount">

                        <br>

                        <div class="text-center"><small><strong class="m-r-10">Hinweis: </strong>                                     Mit dieser Zahlung wird nur das Guthaben des Kundenkontos aufgeladen. Guthaben kann
                                    nicht wieder ausgezahlt werden.</small></div>

                        <br>

                        <button type="submit" name="payNow" class="btn btn-block btn-outline-success">Guthaben aufladen</button>

                    </form>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</section>