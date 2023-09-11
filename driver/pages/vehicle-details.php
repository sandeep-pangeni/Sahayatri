<?php
$detail_id = $obj->select('vehicles', '*', 'id', array($_GET['id']));
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <span onclick="history.back(-1);"><i class="fa fa-arrow-circle-left text-dark fa-2x"></i></span>
        </div>

        <style>
            .img-container{
                position: relative;
                display: block;
                overflow: hidden;
            }
            
            .img-container img{
                transition: all 800ms ease;
                transform: rotate(-10deg);
            }

            .img-container:hover img{
                transform: scale(1.25);
                transform: rotate(0deg);
            }

        </style>
        <div class="col-lg-12 mt-3">
            <div class="row">
                <div class="col-lg-6">
                    <div class="img-container">
                        <img src="<?= file_url($detail_id[0]['photo']) ?>" alt="<?= $detail_id[0]['brand'] ?>" class="img-fluid w-100 h-100 img-thumbsnail">
                    </div>
                    <div class="card-footer border text-center border-secondary">
                        <h4><?= $detail_id[0]['v_no'] ?></h4>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="py-lg-4">
                        <h4><strong>Brand : </strong> <?= $detail_id[0]['brand'] ?></h4>
                        <hr>

                        <p><strong>Price(per day) : </strong> Rs. <?= $detail_id[0]['price'] ?></p>
                        <p><strong>Seat Capacity: </strong> <?= $detail_id[0]['seat'] ?></p>
                        <p><strong>Description: </strong> <?= $detail_id[0]['description'] ?></p>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>