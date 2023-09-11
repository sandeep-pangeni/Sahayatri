<?php
$isRequested = $obj->Query("SELECT * from bookings where user = $uid");

$pending_quer =  $obj->Query("SELECT count(id) as pend_count from bookings where user = $uid AND status = '0' ");

$confirmed_quer =  $obj->Query("SELECT count(id) as conf_count from bookings where user = $uid AND status = '1' ");

$cancelled_quer =  $obj->Query("SELECT count(id) as canc_count from bookings where user = $uid AND status = '2' ");

$total_quer =  $obj->Query("SELECT count(id) as tot_count from bookings where user = $uid");
?>

<?php
if ($isRequested) { ?>

<div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-3 mb-3">
                        <a href="<?= base_url('pending-bookings.php') ?>">
                            <div class="card card-body">
                                <h5>Pending Requests</h5>
                                <div class="d-flex mt-2">
                                    <div><i class="fa fa-history fa-2x text-info"></i></div>
                                    <div class="mx-3 px-3"><h4><strong><?= $pending_quer[0]->pend_count ?></strong></h4></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <a href="<?= base_url('confirmed-bookings.php') ?>">
                            <div class="card card-body">
                                <h5>Confirmed Requests</h5>
                                <div class="d-flex mt-2">
                                    <div><i class="fa fa-check-circle fa-2x text-success"></i></div>
                                    <div class="mx-3 px-3"><h4><strong><?= $confirmed_quer[0]->conf_count ?></strong></h4></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <a href="<?= base_url('cancelled-bookings.php') ?>">
                            <div class="card card-body">
                                <h5>Cancelled Requests</h5>
                                <div class="d-flex mt-2">
                                    <div><i class="fa fa-times-circle fa-2x text-danger"></i></div>
                                    <div class="mx-3 px-3"><h4><strong><?= $cancelled_quer[0]->canc_count ?></strong></h4></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <div class="card card-body">
                            <h5>Total Requests</h5>
                            <div class="d-flex mt-2">
                                <div><i class="fa fa-bar-chart fa-2x text-primary"></i></div>
                                <div class="mx-3 px-3"><h4><strong><?= $total_quer[0]->tot_count ?></strong></h4></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php  } else { ?>
    <div style="font-size: 1.6rem;">
        <p class="text-danger"><strong class="text-dark"><?= ucfirst($loggedInUser) ?></strong>, you haven't booked any vehicle yet!</p>
        <a class="btn btn-outline-primary" href="<?= exit_url('') ?>"> <i class="fa fa-long-arrow-left"></i> &nbsp; Book your first ride.</a>
    </div>
<?php } ?>