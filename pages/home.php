<?php
$category = $obj->select('category');
?>
<section class="sect-home d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-body banner-description">
                            <h1 class="banner-heading"><strong class="d-block">Sahayatri</strong><span>an Online Vehicle Renting Platform</span></h1>
                            <div class="search-form-container">
                                <form action="pages/search.php" method="GET">
                                    <div class="card-header">
                                        <!-- <p>
                                            We provide you with the best feature vehicle booking (with or without* driver).
                                        </p>
                                        <p> You can book anything like car, jeep, tata motor, bus etc.
                                        </p>
 -->

                                        <div class="form-group d-flex">
                                            <select class="form-control form-control-lg border border-secondary" name="category" id="category" required>
                                                <option value="" selected> Which vehicle you want to book ?</option>
                                                <?php foreach ($category as $key => $value) : ?>
                                                    <option class="text-capitalize" value="<?= $value['id'] ?>"><?= $value['vname'] ?></option>
                                                <?php endforeach ?>
                                            </select>

                                            <button type="submit" class="btn btn-primary" name="search" value="searchVehicle" style="border-radius: 0">Search</button>

                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="banner">
                            <img src="assets/images/banner.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>