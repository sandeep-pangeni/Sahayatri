<?php
$user_profile = $obj->select('users', '*', 'id', array($_GET['id']));
// print_r($user_profile);
?>

<style>
    li {
        line-height: 2.5;
    }

    .profile-card img {
        width: 250px;
        height: 220px
    }

    .profile-card li i {
        display: inline-flex;
        background-color: #f2f2ff;
        font-size: 1.3rem;
        color: #444;
        height: 30px;
        width: 30px;
        border-radius: 50%;
        justify-content: center;
        align-items: center;
    }
</style>

<div class="container">
    <div class="row">
        <h2 onclick="history.back();" class="m-b-25 go-back pe-auto"><i class="fas fa-chevron-circle-left"></i></h2>
        <div class="col-sm-12 bg-white">
            <div class="mt-3 profile-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 d-flex">
                            <img src="<?= file_user_url($user_profile[0]['profile']) ?>" alt="<?= $user_profile[0]['name'] ?>">
                            <div class="py-3 mx-4">
                                <ul>
                                    <li class="card-header mb-3">
                                        <h4 class=""><?= $user_profile[0]['name'] ?></h4>
                                    </li>

                                    <li> <i class="fa fa-map-marker"></i> <?= $user_profile[0]['address'] ?> </li>
                                    <li> <i class="fa fa-envelope"></i> <?= $user_profile[0]['email'] ?> </li>
                                    <li><i class="fa fa-phone"></i> <?= $user_profile[0]['phone'] ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>