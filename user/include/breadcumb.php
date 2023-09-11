<?php
$url1 = isset($_GET['url']) ? $_GET['url'] : 'dashboard';
$url2 = str_replace('.php', '', $url);
$pagename = ucwords(str_replace("-", " ", $url2));
?>
<div class="card text-center card-header mb-3">
    <h4 class="text-dark">

        <?php if ($url2 == 'dashboard') { ?>
            <i class="fa fa-home"></i>
        <?php } elseif ($url2 == 'confirmed-bookings') { ?>
            <i class="fa fa-check-circle text-success"></i>
        <?php } elseif ($url2 == 'cancelled-bookings') { ?>
            <i class="fa fa-times-circle text-danger"></i>
        <?php } elseif ($url2 == 'pending-bookings') {?>
            <i class="fa fa-history"></i>
            <?php } ?>
        <?= $pagename ?>
    </h4>
</div>