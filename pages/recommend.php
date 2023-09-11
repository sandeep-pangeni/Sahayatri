<?php
require_once('../config/config.php');
require_once('../config/db.php');

$conn = mysqli_connect("localhost", "root", "", "vrs");
if ($conn->connect_error) {
    die("Failed to connect!" . $conn->connect_error);
}

if (isset($_POST['query'])) {
    $inpText1 = $_POST['query'];
    $inpText = metaphone($_POST['query']);
    $query = $obj->query("SELECT * from vehicles join category on category.id = vehicles.category where vehicles.index_search like '%$inpText%' or category.index_search like '%$inpText%'");

    // if (empty($query)) {
    //     $a_pre =  "%" . $inpText1;
    //     $query = $obj->query("SELECT * from vehicles where brand like '$a_pre'");
    // }
}
?>

<style>
    .resCard::-webkit-scrollbar {
        display: none;
    }

    .resCard:hover ::-webkit-scrollbar {
        display: block;
    }
</style>
<div class="container mt-3" id="rcontainer" style="min-height:50vh;position:fixed;left:0;width:100%;right:0;z-index:1000">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow position-relative">
                <span class="position-absolute" id="closeRes" style="right:0;top:-14px;right:-7px;font-size:1.5rem;cursor:pointer;z-index:200"> <i class="bi bi-x-circle-fill text-dark"></i></span>
                <div class="resScroll" style="max-height:100vh;overflow:hidden;overflow-y:scroll">
                    <div class="card-header p-3 shadow-sm" style="background-color:#d4e4e7">
                        <h5>Search results for : <span class="bg-warning p-1"><?= $inpText1 ?></span></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php
                            if ($query) { ?>
                                <?php foreach ($query as $key => $value) : ?>
                                    <div class="col-lg-4 col-12 data-col mb-4">
                                        <?php
                                        $today = date('Y-m-d');

                                        $vn = $value->v_no;

                                        $checkIsAvailable = $obj->Query("SELECT max(to_date) as maxd from bookings where vehicle_no = '$vn' and status between -1 and 2");

                                        $max_day = $checkIsAvailable[0]->maxd;

                                        if ($max_day >= $today) { ?>
                                            <div class="my-1"> <span class="text-light rounded-pill bg-danger p-1 ">#Not Available</span> </div>
                                        <?php } else { ?>
                                            <div class="my-1"><span class="text-light rounded-pill bg-success p-1 ">#Available</span></div> <?php   } ?>

                                        <div class="shadow-sm">
                                            <div class="image-container">
                                                <img src="<?= file_url($value->photo) ?>" alt="Avatar" class="w-100" style="height:30vh">
                                                <div class="centered-data">
                                                    <?php
                                                    $vehjID_quer = $obj->select('vehicles', '*', 'brand', array($value->brand));
                                                    ?>
                                                    <a href="<?= base_url('pages/book-vehicle.php?brand=' . $value->brand . '&id=' . $vehjID_quer[0]['id']) ?>" class="text-decoration-none">
                                                        <div class="text">Book Now</div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-footer p-3">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <h6 class="strong fw-bold"><?= $value->v_no ?> </h6>
                                                    </div>
                                                    <div class="col-5">
                                                        <h6>Capacity: <?= $value->seat ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>

                            <?php } else { ?>
                                <h5 class="text-danger">No results found</h5><?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('mouseup', function(e) {
        var container = document.getElementById('rcontainer');
        var closeRes = document.getElementById('closeRes');


        closeRes.onclick = function() {
            if (container.style.display !== 'none') {
                container.style.display = 'none';
            } else {
                container.style.display = 'block';
                var collection = document.getElementsByClassName("container");
                collection.style.opacity = "0.1";
            }
        };

        if (!container.contains(e.target)) {
            container.style.display = 'none ';
        }
    });
</script>