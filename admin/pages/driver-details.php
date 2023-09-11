<?php
$detail_id = $obj->select('drivers', '*', 'id', array($_GET['id']));
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 goback">
            <span onclick="history.back(-1);"><i class="fa fa-arrow-circle-left text-dark fa-2x"></i></span>
        </div>

        <style>
            .img-container {
                position: relative;
                display: block;
                overflow: hidden;
            }

            .img-container img {
                height:50vh;
                transition: all 800ms ease;
            }

            .img-container:hover img {
                transform: scale(1.25);
            }
        </style>
        <div class="col-lg-12 mt-3">
            <div class="row">
                <div class="col-lg-6">
                    <div class="img-container">
                        <img src="<?= file_url($detail_id[0]['license_photo']) ?>" alt="<?= $detail_id[0]['name'] ?>'s license ?>" class="img-fluid w-100 img-thumbsnail">
                    </div>
                    <div class="card-footer bg-light shadow text-center">
                        <h4>License No : <?= $detail_id[0]['license_no'] ?></h4>
                    </div>
                </div>


                <style>
                    .detail-ul li {
                        line-height: 2.5;
                    }

                    .detail-ul li {
                        display: flex;
                    }


                    .detail-ul li span {
                        background-color: #e9f9ff;
                        /* padding :10px; */
                        width: 30px;
                        height: 30px;
                        font-size: 1rem;
                        display: inline-flex;
                        justify-content: center;
                        align-items: center;
                        border-radius: 50%;
                    }
                </style>
                <div class="col-lg-6">
                    <div class="py-lg-4">
                        <div class="">
                            <div class="card-header p-2 bg-info">
                                <h4 class="px-2">Driver Name : <?= $detail_id[0]['name'] ?></h4>
                            </div>
                            <div class="p-3">
                                <ul class="detail-ul">
                                    <li><strong><span><i class="ti ti-location-pin"></i></span> Address:</strong> <?= $detail_id[0]['address'] ?></li>
                                    <li><strong><span><i class="ti ti-email"></i></span> Email:</strong> <?= $detail_id[0]['email'] ?></li>
                                    <li><strong><span><i class="fa fa-phone"></i></span> Phone:</strong> <?= $detail_id[0]['phone'] ?></li>
                                    <li><strong><span><i class="fa fa-money"></i></span> Rate:</strong> Rs.<?= $detail_id[0]['rate'] ?> (per day)</li>
                                    <li><strong><span><i class="ti ti-flag-alt"></i></span> Category:</strong>
                                        <?php
                                        $catag_quer = $obj->select('category', '*', 'id', array($detail_id[0]['v_category']));
                                        $category_name = $catag_quer[0]['vname'];
                                        ?>
                                        <?= $category_name ?>
                                    </li>
                                </ul>

                                <div style="background-color: #f5f5f5;" class="p-3">
                                <h4>Ratings appear here...</h4>


                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>