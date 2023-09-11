<?php
ob_start();
session_start();
require_once('../config/config.php');
require_once('../config/db.php');

$title = "Search Vehicle - Sahayatri | A Vehicle Renting System";
require_once('../includes/header.php');
require_once('../includes/navbar.php');


if (isset($_GET['category'])) {
    $id = $_GET['category'];
    $search_data = $obj->select('vehicles', '*', 'category', array($id));
    $searched_quer = $obj->select('category', '*', 'id', array($id));
    $searched_catag = $searched_quer[0]['vname'];
} else {
    $id = $_GET['id'];
    $searched_quer = $obj->select('category', '*', 'id', array($id));
    $searched_catag = $searched_quer[0]['vname'];
    $search_data = $obj->select('vehicles', '*', 'category', array($searched_quer[0]['id']));
}
?>

<section class="sect-intro d-flex flex-column justify-content-center align-items-center" style="height:17vh;background-color:#008ecb;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-white">Search results for : <?= $searched_catag ?> </h4>
            </div>
        </div>
    </div>
</section>

<section class="sect-search mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <?php foreach ($search_data as $key => $value) : ?>
                        <div class="col-4 mb-3 data-col">
                            <div class="image-container">
                                <img src="<?= file_url($value['photo']) ?>" alt="Avatar" class="indiv-image" style="width:100%">
                                <div class="centered-data">
                                    <a href="<?= base_url('pages/book-vehicle.php?brand=' . $value['brand'] . '&id=' . $value['id']) ?>" class="text-decoration-none">
                                        <div class="text">Book Now</div>
                                    </a>
                                </div>
                            </div>

                            <div class="card-footer p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <h5><?= $value['brand'] ?></h5>
                                    </div>
                                    <div class="col-4">
                                        <h6>Capacity:<?= $value['seat'] ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once('../includes/footer.php');
?>