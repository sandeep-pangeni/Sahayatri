<?php
$new_boookings = $obj->Query("SELECT * from bookings where driver = $did order by time desc");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if ($new_boookings) { ?>
                <table class="table dataTable table-responsive-lite">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Vehicle</th>
                            <th>Vehicle No.</th>
                            <th>Booked by</th>
                            <th>Cost</th>
                            <th>Booking Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($new_boookings as $key => $value) : ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td>
                                    <?php
                                    $which_v_equr = $obj->select('category', '*', 'id', array($value->category));
                                    $which_v = $which_v_equr[0]['vname'];
                                    ?>
                                    <?= $which_v ?>
                                </td>
                                <td><?= $value->vehicle_no ?></td>
                                <td>
                                    <?php
                                    $which_user_equr = $obj->select('users', '*', 'id', array($value->user));
                                    $WhoUser = $which_user_equr[0]['name'];

                                    ?>
                                    <!-- //open profile modal  -->
                                    <strong class="cursor-pointer text-capitalize" data-toggle="modal" data-target="#exampleModal<?= $value->id ?>"><?= $WhoUser ?></strong>

                                </td>
                                <td>Rs.<?= $value->cost ?></td>
                                <td>
                                    <ul class="p-0 list-unstyled">
                                        <li><strong>From: </strong><?= $value->from_date ?></li>
                                        <li><strong>To: </strong><?= $value->to_date ?></li>
                                        <li><strong>(Duration - <?= $value->duration ?> days)
                                        </li></strong>
                                    </ul>
                                </td>
                                <td>
                                    <?php
                                    if ($value->status == 2) { ?>
                                        <span class="badge badge-danger">Cancelled</span>
                                    <?php } elseif($value->status == 0) { ?>
                                        <span class="badge badge-info">Pending</span>
                                        <?php }elseif($value->status == 1) { ?>
                                            <span class="badge badge-success">Confirmed</span>
                                            <?php } ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="text-centser">
                    <h5 class="text-danger">No bookings yet!</h5>
                </div>

            <?php } ?>
        </div>
    </div>
</div>