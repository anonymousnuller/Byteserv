<?php
$currPage = 'team_Benutzerverwaltung_admin';
include 'app/controller/PageController.php';
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
                <div class="card card-body">

                    <table id="my_table" style="color:white;" class="table table-nowrap display" data-order='[[ 0, "desc" ]]' data-page-length='10'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Benutzername</th>
                                <th>E-Mail</th>
                                <th>Guthaben</th>
                                <th>Kunde seit</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $SQL = $db -> prepare("SELECT * FROM `users` ORDER BY `id` DESC");
                        $SQL->execute();
                        if ($SQL->rowCount() != 0) {
                        while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){?>
                            <tr>
                                <th><?php echo $row['id']; ?></th>
                                <th><?php echo $row['username']; ?></th>
                                <th><?php echo $row['email']; ?></th>
                                <th><?php echo $row['amount']; ?>€</th>
                                <td><?php echo $row['created_at']; ?></td>
                                <td><a href="<?php echo $url; ?>team/user/<?php echo $row['id']; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-pencil-alt"></i></a></td>
                            </tr>
                        <?php } } ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
</section>
<script>
$(document).ready( function () {
    $('#my_table').DataTable();
} );
</script>