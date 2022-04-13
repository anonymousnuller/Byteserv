<?php
$currPage = 'team_Benutzerverwaltung_admin';
include 'app/controller/PageController.php';
include 'app/manager/team/user.php';

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
        <div class="row">

            <div class="col-md-12">
                <div class="container card card-body">
                    <form method="post">
                        <div class="row">

                            <div class="col-md-6">
                                <label>Benutzername</label>
                                <input name="username" value="<?= $userInfos['username']; ?>" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>E-Mail</label>
                                <input name="email" value="<?= $userInfos['email']; ?>" class="form-control">
                            </div>

							<div class="col-md-12"> <br> </div>
														

                            <div class="col-md-12"> <br> </div>

                            <div class="col-md-6">
                                <label>Status</label>
                                <select class="form-control" name="state">
                                    <option <?php if($userInfos['state'] == 'pending'){ echo 'selected'; } ?> value="pending">Inaktiv</option>
                                    <option <?php if($userInfos['state'] == 'active'){ echo 'selected'; } ?> value="active">Aktiv</option>
                                    <option <?php if($userInfos['state'] == 'disabled'){ echo 'selected'; } ?> value="disabled">Deaktiviert</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label>Rolle</label>
                                <select class="form-control" name="role">
                                    <option <?php if($userInfos['role'] == 'customer'){ echo 'selected'; } ?> value="customer">Kunde</option>
                                    <option <?php if($userInfos['role'] == 'supporter'){ echo 'selected'; } ?> value="supporter">Supporter</option>
                                    <option <?php if($userInfos['role'] == 'admin'){ echo 'selected'; } ?> value="admin">Admin</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <br>
                                <button class="btn btn-success" type="submit" name="updateUser">Speichern</button>
                            </div>

                        </div>
                    </form>
                </div>

                <br>

                <div class="card card-body container">
                    <h4 style="margin-top: 0px;">Passwort ändern</h4>
                    <form method="post">
                        <div class="row">

                            <div class="col-md-6">
                                <label>Passwort</label>
                                <input name="password" placeholder="Passwort eingeben" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Passwort wiederholen</label>
                                <input name="password_repeat" placeholder="Passwort eingeben" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <br>
                                <button class="btn btn-success" type="submit" name="changePassword">Passwort ändern</button>
                            </div>

                        </div>
                    </form>
                </div>
				<div class=""><br></div>
                <div class="card card-body container">
                    <h4 style="margin-top: 0px;">Guthaben (<?= $userInfos['amount'] ?>€)</h4>
                    <form method="post">
                        <div class="row">

                            <div class="col-md-6">
                                <label>Guthaben hinzufügen</label>
                                <input min="0" name="add_amount" type="number" placeholder="Guthaben hinzufügen" class="form-control">
                                <br>
                                <input name="add_amount_desc" placeholder="Beschreibung" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Guthaben entfernen</label>
                                <input min="0" name="remove_amount" type="number" placeholder="Guthaben entfernen" class="form-control">
                                <br>
                                <input name="remove_amount_desc" placeholder="Beschreibung" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <br>
                                <button class="btn btn-outline-success" type="submit" name="addguthaben">Hinzufügen</button>
                                <button class="btn btn-outline-danger" style="float: right;" type="submit" name="remguthaben">Entfernen</button>
                            </div>

                        </div>
                    </form>
                </div>				
            </div>
        </div>
    </div>
</section>
