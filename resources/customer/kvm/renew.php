<?php
$currPage = 'back_KVM Server verlängern';
include 'app/controller/PageController.php';
include 'app/manager/customer/kvm/renew.php';
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
    <br>
    <div class="container col-nt-hid-pg ">
        <div class="row">

            <div class="col-md-9">
                <div class="card card-body panel-body">

                    <form method="post">

                        <label for="duration">Laufzeit</label>
                        <select style="color: white;" id="duration" name="duration" class="form-control bg-light">
                            <option value="30" data-factor="1">30 Tage</option>
                            <option value="60" data-factor="2">60 Tage</option>
                            <option value="90" data-factor="3">90 Tage</option>
                        </select>

                        <br>

                        <button type="submit" class="btn btn-outline-primary" name="renew">Kostenpflichtig verlängern</button>

                    </form>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-body panel-body text-center">

                    Kostenübersicht
                    <h3 data-amount="">0.00 €</h3>

                </div>
            </div>

        </div>
    </div>
    </div>
</section>
<br>

<script>
    $('#slots').on('input', function() {update();});
    $("select, textarea").change(function() { update(); } ).trigger("change");

    function update(){
        var sum = "<?= $serverInfos['price']; ?>";

        var price = Number(sum * $("#duration").find("option:selected").data("factor"))
            .toLocaleString("de-DE", {minimumFractionDigits: 2, maximumFractionDigits: 2});
        $("*[data-amount]").html(price + " €");
    }

    $(document).ready(function(){
        update();
    });
</script>