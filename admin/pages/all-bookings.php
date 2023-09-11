<?php
$all_bookings = $obj->Query("SELECT * from bookings ORDER BY time desc");
// print_r($all_bookings);

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'cancel') {
        $status['status'] = 2;
        $obj->Update("bookings", $status, "id", array($_GET['id']));
        echo '<script>alert("Request cancelled!")</script>';
        echo "<script> window.location.href='" . base_url('all-bookings.php') . "'</script>";
    }  elseif($_GET['action'] == 'confirm'){
        $status['status'] = 1;
        $obj->Update("bookings", $status, "id", array($_GET['id']));
        echo '<script>alert("Request is confirmed!")</script>';
        echo "<script> window.location.href='" . base_url('all-bookings.php') . "'</script>";

    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if ($all_bookings) { ?>
                <table class="table table-responsive-lite" id="exData">
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
                        <?php foreach ($all_bookings as $key => $value) : ?>
                            <tr <?php if (isset($_GET['action']) && $_GET['action'] == 'focus' && $_GET['id'] == $value->id) { ?> style="border-left:2px solid midnightblue;background-color:#fff" <?php } ?>> 
                                <td><?= ++$key ?></td>
                                <td>
                                    <?php
                                    $which_user_q = $obj->select('users', '*', 'id', array($value->user));

                                    $which_user = $which_user_q[0]['name']; ?>

                                    <strong><?= $which_user ?></strong>
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
                                    if ($value->driver == '0') { ?>
                                    <?php } else { ?>
                                        <?php
                                        $which_driver_equr = $obj->select('drivers', '*', 'id', array($value->driver));
                                        if ($which_driver_equr) {
                                            $which_driver = $which_driver_equr[0]['name'];
                                            $d_photo = $which_driver_equr[0]['profile'];
                                        }
                                        ?>
                                        <!-- //open profile modal  -->
                                        <strong class="cursor-pointer" data-toggle="modal" data-target="#exampleModal<?= $value->id ?>"><?= $which_driver ?></strong>

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
                                        </div><?php } ?>
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
                                    if ($value->status == 0) { ?>
                                        <span class="badge badge-info">Pending</span>
                                    <?php } elseif ($value->status == 1) { ?>
                                        <span class="badge badge-success">Confirmed</span>
                                    <?php } elseif ($value->status == 2) { ?>
                                        <span class="badge badge-danger">Cancelled</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="text-centser">
                    <h5 class="text-danger">No bookings found!</h5>
                </div>

            <?php } ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#exData').DataTable();
    });
</script>