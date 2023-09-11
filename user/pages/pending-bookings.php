<?php
$new_boookings = $obj->Query("SELECT * from bookings where user = $uid and status = '0' order by id desc");


$pending_bookings_with_d = $obj->Query("SELECT * from bookings where driver!='' and user = $uid and status =  '0' ORDER BY time desc");

$pending_bookings_without = $obj->Query("SELECT * from bookings where  driver='0' and user = $uid and status =  '0' ORDER BY time desc");


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'cancel') {
        $status['status'] = 2;
        $obj->Update("bookings", $status, "id", array($_GET['id']));
        echo '<script>alert("Request cancelled!")</script>';
        echo "<script> window.location.href='" . base_url('pending-bookings.php') . "'</script>";
    }
}


// if (isset($_GET['action'])) {
//     if ($_GET['action'] == 'd') {
//         print_r($_GET['id']);
//         $checkId = $_GET['id'];
//         $checkIsValidate = $obj->Query("SELECT * from bookings where driver!='' and user = $uid and status =  '0' and id='$checkId' ");
//         if($checkIsValidate){
//            echo "delete";
//         }
//         else{
//             echo "cannot delete";
//         }

//         die;

//         $obj->Delete("bookings", "id", array($_GET['id']));
//         echo '<script>alert("Request deleted!")</script>';
//         echo "<script> window.location.href='" . base_url('pending-bookings.php') . "'</script>";
//     }
// }
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'd') {
        $checkId = $_GET['id'];
        $checkIsValidate = $obj->Query("SELECT * from bookings where driver='' and user = $uid and status =  '0' and id='$checkId' ");
        if($checkIsValidate){
            $obj->Delete("bookings", "id", array($_GET['id']));
            echo '<script>alert("Request deleted!")</script>';
            echo "<script> window.location.href='" . base_url('pending-bookings.php') . "'</script>";
        }
        else{
            echo '<script>alert("Sorry You cannot delete!")</script>';
            echo "<script> window.location.href='" . base_url('pending-bookings.php') . "'</script>";
        }
    }
}



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
                    <?php if ($pending_bookings_with_d) { ?>
                        <table class="table dataTable table-responsive-lite">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Vehicle</th>
                                    <th>Vehicle No.</th>
                                    <th>Driver</th>
                                    <th>Cost</th>
                                    <th>Booking Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($pending_bookings_with_d as $key => $value) : ?>
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
                                            if ($value->driver == '0') { ?>
                                            <?php } else { ?>
                                                <?php
                                                $which_driver_equr = $obj->select('drivers', '*', 'id', array($value->driver));
                                                if ($which_driver_equr) {
                                                    $which_driver = $which_driver_equr[0]['name'];

                                                    $driver_p = $which_driver_equr[0]['profile'];
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
                                                                <img src="<?= file_driver_url($driver_p) ?>" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><?php } ?>
                                        </td>
                                        <td>Rs.<?= $value->cost ?></td>
                                        <td>
                                            <ul class="p-0 list-unstyled">
                                                <li><strong>From: </strong><?= $value->from_date ?></li>
                                                <li><strong>To: </strong><?= $value->to_date ?></li>
                                                <li class="mt-2"><strong class="small bg-light text-dark p-1" style="border-top:1px solid #c7c7c7">(Duration: <?= $value->duration ?>
                                                        <?php if ($value->duration <= 1) { ?> day <?php } else { ?> days <?php } ?>)
                                                </li></strong>
                                            </ul>

                                        </td>
                                        <td>
                                            <?php
                                            if ($value->status == 0) { ?>
                                                <span class="badge badge-info">Pending</span>
                                            <?php } ?>
                                        </td>

                                        <td><a href="<?= base_url('pending-bookings.php?action=cancel&id=' . $value->id) ?>" class="btn btn-outline-danger  btn-sm" onclick="return confirm('Are you sure you want to cancel?')"> <i class="bi bi-trash-fill"></i> Cancel </a>

                                            <a href="<?= base_url('pending-bookings.php?action=d&id=' . $value->id) ?>" class="btn btn-light border border-danger text-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')"> <i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <div class="text-centser">
                            <h5 class="text-danger">No pending bookings with driver !</h5>
                        </div>
                    <?php } ?>
                </div>

                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <?php if ($pending_bookings_without) { ?>
                        <table class="table dataTable table-responsive-lite">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Vehicle</th>
                                    <th>Vehicle No.</th>
                                    <th>Cost</th>
                                    <th>Booking Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($pending_bookings_without as $key => $value) : ?>
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
                                            if ($value->status == 0) { ?>
                                                <span class="badge badge-info">Pending</span>
                                            <?php } ?>
                                        </td>

                                        <td><a href="<?= base_url('pending-bookings.php?action=cancel&id=' . $value->id) ?>" class="btn btn-outline-danger  btn-sm" onclick="return confirm('Are you sure you want to cancel?')"> <i class="bi bi-trash-fill"></i> Cancel </a>

                                            <a href="<?= base_url('pending-bookings.php?action=d&id=' . $value->id) ?>" class="btn btn-light border border-danger text-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')"> <i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <div class="text-centser">
                            <h5 class="text-danger">No pending bookings without driver!</h5>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>