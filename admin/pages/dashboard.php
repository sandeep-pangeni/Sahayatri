<?php
$users = $obj->select('users');


$bookings = $obj->Query("SELECT * from bookings ORDER BY time desc");


?>

<style>
    .go-back{
        display: none;
    }
</style>
<div class="container">
    <div class="row justify-content-end">

        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h5> New Bookings</h5>
                </div>
                <div class="card-body">
                    <?php foreach ($bookings as $key => $value) : ?>
                        <a href="<?= base_url('all-bookings.php?id=' . $value->id) ?>&action=focus">
                            <div class="row mb-3">
                                <div class="col-9">
                                    <ul class="list-unstyled d-flex">
                                        <li>
                                            <div class="div">
                                                <?php
                                                $user_p = $obj->select('users', '*', 'id', array($value->user));
                                                $username = $user_p[0]['name'];
                                                $userprofile = $user_p[0]['profile'];
                                                $userphone = $user_p[0]['phone'];
                                                ?>
                                                <?php if ($userprofile) { ?>
                                                    <img src="<?= file_user_url($userprofile) ?>" alt="" class="user-avatar">
                                                <?php } else { ?>
                                                    <img src="<?= exit_url('assets/images/empty-profile-picture.jpg') ?>" alt="" class="user-avatar">
                                                <?php } ?>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="div ml-2">
                                                <h6 class="text-capitalize pt-2 d-inline-flex"><?= $username ?></h6> <span>booked a
                                                    <?php

                                                    $v_category = $obj->select('category', '*', 'id', array($value->category));
                                                    $cat_name = $v_category[0]['vname'];
                                                    ?>
                                                    <?= $cat_name ?>
                                                    <?php
                                                    if ($value->driver == 0) { ?>
                                                        <sup class="badge badge-info text-nowrap">
                                                            Without Driver </sup> <?php } else { ?> with <strong class="d-inline-flex">
                                                            <?php
                                                                                    $driv = $obj->select('drivers', '*', 'id', array($value->driver));
                                                                                    $dname = $driv[0]['name'];
                                                            ?>
                                                            <?= $dname ?>
                                                        </strong> <?php } ?>
                                                    </strong>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-3">
                                    <?= $value->time ?> </div>

                            </div>
                        </a>


                    <?php endforeach ?>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card">
                <div class="card-header text-center">
                    Users
                </div>
                <div class="card-body" style="max-height: 45vh;overflow:hidden;overflow-y:scroll">
                    <?php foreach ($users as $key => $value) : ?>
                        <div class="row mb-3 list-group-item d-flex">
                            <div class="col-4">
                                <?php if ($value['profile']) { ?>
                                    <img src="<?= file_user_url($value['profile']) ?>" alt="" class="user-avatar">
                                <?php } else { ?>
                                    <img src="<?= exit_url('assets/images/empty-profile-picture.jpg') ?>" alt="" class="user-avatar">
                                <?php } ?>
                            </div>
                            <div class="col-8">
                                <a href="<?= base_url('user-profile.php?id=' . $value['id']) ?>">
                                    <h6 class="text-capitalize pt-2"><?= $value['name'] ?></h6>
                                </a>

                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>