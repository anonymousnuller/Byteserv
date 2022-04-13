<?php
$currPage = 'front_KVM Server verwalten';
include 'app/controller/PageController.php';
include 'app/manager/customer/kvm/manage.php';
?>
<form method="post">
    <div class="modal fade bd-example-modal-lg" id="reinstallModal" tabindex="-1" role="dialog" aria-labelledby="reinstallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reinstallModalLabel">Rootserver neuinstallieren</h5>
                </div>
                <div class="modal-body">

                    <label>Betriebssystem:</label>
                    <select class="form-control" name="osid" required="required">
                            <?php
                                    $SQL = $db->prepare("SELECT * FROM `kvm_os`");
                                    $SQL->execute(array());
                                    if ($SQL->rowCount() != 0) { while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                                    <?php } } ?>
                        </select><br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Schließen</button>
                    <button type="submit" class="btn btn-outline-success" name="ReinstallKVM">Server neuinstallieren</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form method="post">
    <div class="modal fade bd-example-modal-lg" id="changeRootModal" tabindex="-1" role="dialog" aria-labelledby="changeRootModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeRootModalLabel">Root-Passwort ändern</h5>
                </div>
                <div class="modal-body">

                    <label>Neues Rootpasswort:</label>
                    <input class="form-control" name="root_pw" placeholder="*******" value="">
                    <br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Schließen</button>
                    <button type="submit" class="btn btn-outline-success" name="ChangeRootKey">Root-Passwort ändern</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form method="post">
    <div class="modal fade bd-example-modal-lg" id="changeHostModal" tabindex="-1" role="dialog" aria-labelledby="changeHostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeHostModalLabel">Hostname ändern</h5>
                </div>
                <div class="modal-body">

                    <label>Neuer Hostname:</label>
                    <input class="form-control" name="hostname" value="<?= $serverInfos['hostname']; ?>">
                    <br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Schließen</button>
                    <button type="submit" class="btn btn-outline-success" name="ChangeHostName">Hostname ändern</button>
                </div>
            </div>
        </div>
    </div>
</form>

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
            <div class="col-md-8">
                <div class="card card-body shadow mb-5">
                    <table class="table">
                        <tbody>
                            <tr style="color:white">
                                <td>Server-ID</td>
                                <td><?= $serverInfos['id']; ?></td>
                            </tr>
                            <tr style="color:white">
                                <td>Server-IP</td>
                                <td><?= $serverInfos['serv_ip']; ?> <i style="cursor: pointer;" class="fas fa-copy copy-btn" data-clipboard-text="<?=$serverInfos['serv_ip']?>" data-toggle="tooltip" title="IP-Adresse kopieren"></i></td>
                            </tr>
                            <tr style="color:white">
                                <td>Passwort</td>
                                <td>                                                <span class="ml-2">
                                                    <span id="root_password">***********</span>
                                                    <span style="cursor: pointer;" id="root_icon" onclick="passwordEye('root');">
                                                        <i class="far fa-eye"></i>
                                                    </span>

                                                    <i style="cursor: pointer;" class="fas fa-copy copy-btn" data-clipboard-text="<?=$serverInfos['root_pw']?>" data-toggle="tooltip" title="Passwort kopieren"></i>
                                                </span></td>
                            </tr>
                            <tr style="color:white">
                                <td>Status</td>
                                <td><?= $state ?></td>
                            </tr>                           
                            <tr style="color:white">
                                <td>Laufzeit</td>
                                <td><span id="countdown">Lädt...</span></td>
                            </tr>
                            <tr style="color:white">
                                <td>Kosten</td>
                                <td><?= $serverInfos['price']; ?>€ pro 30 Tage</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
			</div>
				
                <div class="col-md-4">
				<div class="card card-body text-center shadow mb-5">
                    <form method="POST" action="">
							<button class="btn btn-outline-success btn-block" type="submit" name="StartKVM">Starten</button>
							<button class="btn btn-outline-danger btn-block" type="submit" name="StopKVM">Stoppen</button>
							<button class="btn btn-outline-warning btn-block" type="submit" name="RebootKVM">Neustarten</button>
							<hr style="background-color: white;">
							<a class="btn btn-block btn-outline-info" href="<?= $helper->url(); ?>kvm/renew/<?= $id; ?>">Verlängern</a>
							<hr style="background-color: white;">
                            <button class="btn btn-outline-warning btn-block" data-toggle="modal" data-target="#reinstallModal" type="button">Neuinstallieren</button>
                            <button class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#changeRootModal" type="button">Root-Passwort ändern</button>
                            <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#changeHostModal" type="button">Hostname ändern</button>
                     </form>
					 </div>
					 </div>
            <div class="row">
                <br>
            </div>       
            </div>
            <br>

    </div>


</section>
<script type="text/javascript">
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}
</script>

<script>

let rootserver = true;

    function passwordEye(type) {
        if(type == 'root'){
            if(rootserver){
                $('#root_password').html("<?= $serverInfos['root_pw']; ?>");
                $('#root_icon').html('<i class="far fa-eye-slash"></i>');
                rootserver = false;
            } else {
                $('#root_password').html('***********');
                $('#root_icon').html('<i class="far fa-eye"></i>');
                rootserver = true;
            }
        }
    }

    var countDownDate = new Date("<?= $serverInfos['expire_at']; ?>").getTime();
    var x = setInterval(function() {

        var now = new Date().getTime();
        var distance = countDownDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        if(days == 1){ var days_text = ' Tag' } else { var days_text = ' Tage'; }
        if(hours == 1){ var hours_text = ' Stunde' } else { var hours_text = ' Stunden'; }
        if(minutes == 1){ var minutes_text = ' Minute' } else { var minutes_text = ' Minuten'; }
        if(seconds == 1){ var seconds_text = ' Sekunde' } else { var seconds_text = ' Sekunden'; }

        if(days == 0 && !(hours == 0 && minutes == 0 && seconds == 0)){
            $('#countdown<?= $serverInfos["id"]; ?>').html(hours+hours_text+', '+  minutes+minutes_text+' und ' +  seconds+seconds_text);
            if(days == 0 && hours == 0 && !(minutes == 0 && seconds == 0)){
                $('#countdown<?= $serverInfos["id"]; ?>').html(minutes+minutes_text+' und '+  seconds+seconds_text);
                if(days == 0 && hours == 0 && minutes == 0 && !(seconds == 0)){
                    $('#countdown<?= $serverInfos["id"]; ?>').html(seconds+seconds_text);
                }
            }
        } else {
            $('#countdown').html(days+days_text+', '+  hours+hours_text+', '+  minutes+minutes_text+' und '+  seconds+seconds_text);
        }

        if (distance <= 0) {
            clearInterval(x);
        }
    }, 1000);

    new ClipboardJS('.copy-btn');
</script>