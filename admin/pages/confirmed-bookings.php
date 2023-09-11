<?php
$confirmed_bookings = $obj->Query("SELECT * from bookings where status =  '1' ORDER BY time desc");

$confirmed_bookings_with_d = $obj->Query("SELECT * from bookings where driver!='0' and status =  '1' ORDER BY time desc");

$confirmed_bookings_without = $obj->Query("SELECT * from bookings where  driver='0' and status =  '1' ORDER BY time desc");

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-end mb-4">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">With Driver</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Without Driver</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <?php if ($confirmed_bookings_with_d) { ?>
                        <table class="table DataTable table-responsive-lite" id="exData">
                            <thead>
                                <tr class="bg-white">
                                    <th>S.N</th>
                                    <th>Booked By</th>
                                    <th>Vehicle</th>
                                    <th>Driver</th>
                                    <th>Cost</th>
                                    <th>Booking Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($confirmed_bookings_with_d as $key => $value) : ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td>
                                            <?php
                                            $which_user_q = $obj->select('users', '*', 'id', array($value->user));

                                            $which_user = $which_user_q[0]['name'];
                                            $license_photo = $which_user_q[0]['license_photo'];
                                            $license_no = $which_user_q[0]['license_no'];
                                            ?>

                                            <strong class="text-capitalize pe-auto"><a href="<?= base_url('user-profile.php?id=' . $value->user) ?>"><?= $which_user ?></a></strong>
                                        </td>
                                        <td class="text-nowrap">
                                            <?php
                                            $which_v_equr = $obj->select('category', '*', 'id', array($value->category));
                                            $which_v = $which_v_equr[0]['vname'];
                                            ?>
                                            <?= $which_v ?> | <?= $value->vehicle_no ?>
                                        </td>
                                        <td>
                                            <?php
                                            $which_driver_equr = $obj->select('drivers', '*', 'id', array($value->driver));

                                            $which_driver = $which_driver_equr[0]['name'];
                                            $d_photo = $which_driver_equr[0]['profile'];

                                            ?>
                                            <!-- //open profile modal  -->
                                            <strong class="pe-auto" data-toggle="modal" data-target="#exampleModal<?= $value->id ?>"><?= $which_driver ?></strong>

                                            <div class="modal fade" id="exampleModal<?= $value->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Driver - <?= $which_driver ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="<?= file_url($d_photo) ?>" alt="" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td> <?php if ($value->cost) { ?>Rs.<?= $value->cost ?> <?php } ?> </td>
                                        <td class="text-nowrap">
                                            <ul class="p-0 list-unstyled">
                                                <li>
                                                    <h6>From: <?= $value->from_date ?> </h6>
                                                </li>
                                                <li>
                                                    <h6>To: <?= $value->to_date ?></h6>
                                                </li>
                                                <li><strong>(Duration - <?= $value->duration ?> days)
                                                </li></strong>
                                            </ul>
                                        </td>
                                        <td>
                                            <?php
                                            if ($value->status == 1) { ?>
                                                <span class="badge badge-success">Confirmed</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <div class="text-centser">
                            <h5 class="text-danger">No confirmed bookings with driver!</h5>
                        </div>
                    <?php } ?>
                </div>

                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <?php if ($confirmed_bookings_without) { ?>
                        <table class="table DataTable table-responsive-lite" id="exData">
                            <thead>
                                <tr class="bg-white">
                                    <th>S.N</th>
                                    <th>Booked By</th>
                                    <th>Vehicle</th>
                                    <th>Cost</th>
                                    <th>Booking Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($confirmed_bookings_without as $key => $value) : ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td>
                                            <?php
                                            $which_user_q = $obj->select('users', '*', 'id', array($value->user));

                                            $which_user = $which_user_q[0]['name'];
                                            $license_photo = $which_user_q[0]['license_photo'];
                                            $license_no = $which_user_q[0]['license_no'];
                                            ?>

                                            <strong data-toggle="modal" data-target="#exampleModal<?= $value->user ?>" class="text-capitalize pe-auto"><?= $which_user ?></strong>
                                            <div class="modal fade" id="exampleModal<?= $value->user ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-capitalize" id="exampleModalLabel"><?= $which_user ?> | <a href="<?= base_url('user-profile.php?id=' . $value->user) ?>" class="text-primary">View Profile</a></h5>

                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <h6>License No : <?= $license_no ?> </h6>
                                                            </div>
                                                            <img src="<?= file_user_url($license_photo) ?>" alt="" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-nowrap">
                                            <?php
                                            $which_v_equr = $obj->select('category', '*', 'id', array($value->category));
                                            $which_v = $which_v_equr[0]['vname'];
                                            ?>
                                            <?= $which_v ?> | <?= $value->vehicle_no ?>
                                        </td>

                                        <td> <?php if ($value->cost) { ?>Rs.<?= $value->cost ?> <?php } ?> </td>
                                        <td class="text-nowrap">
                                            <ul class="p-0 list-unstyled">
                                                <li>
                                                    <h6>From: <?= $value->from_date ?> </h6>
                                                </li>
                                                <li>
                                                    <h6>To: <?= $value->to_date ?></h6>
                                                </li>
                                                <li><strong>(Duration - <?= $value->duration ?> days)
                                                </li></strong>
                                            </ul>
                                        </td>
                                        <td>
                                            <?php
                                            if ($value->status == 1) { ?>
                                                <span class="badge badge-success">Confirmed</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <div class="text-centser">
                            <h5 class="text-danger">No confirmed bookings without driver !</h5>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>