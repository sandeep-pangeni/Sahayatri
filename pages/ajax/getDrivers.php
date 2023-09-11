<?php
require_once('../../config/config.php');
require_once('../../config/db.php');

$drivers = $obj->select('drivers', '*', 'id', array($_GET['id']));

?>


<style>
    .detail-ul li {
        line-height: 2.5;
    }

    .detail-ul li {
        display: flex;
    }


    .detail-ul li span.icons {
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

<?php foreach ($drivers as $key => $value) : ?>
    <div class="card">
        <div class="card-header my-0">
            <h5 class="font-weight-bold">
                <img src="<?= file_driver_url($value['profile']) ?>" style="width:40px;height:40px;border:2px solid #d9d9d9">
                <span class="px-1"><?= $value['name'] ?></span> 
            </h5>
        </div>
        <div class="card-body p-2">
            <ul class="detail-ul p-0 m-0">
                <li><strong><span class="icons"><i class="bx bx-map"></i></span> Address:</strong>&nbsp; <?= $value['address'] ?></li>
                <li><strong><span class="icons"><i class="bi bi-envelope"></i></span> Email:</strong>&nbsp; <?= $value['email'] ?></li>
                <li><strong><span class="icons"><i class="bi bi-phone"></i></span> Phone:</strong>&nbsp; <?= $value['phone'] ?></li>
                <li><strong><span class="icons"><i class="bx bx-money"></i></span> Rate:</strong> &nbsp; Rs. <span style="background:none" id=""><?= $value['rate'] ?></span> (per day)
                    <input type="hidden" id="driver_rate" value="<?= $value['rate'] ?>">

                </li>

            </ul>
        </div>
    </div>
<?php endforeach ?>