<?php
$users = $obj->select('users');
print_r($users);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    Users
                </div>
                <div class="card-body" style="max-height: 45vh;overflow:hidden;overflow-y:scroll">
                    <?php foreach ($users as $key => $value) : ?>
                        <div class="row mb-3 list-group-item d-flex">
                            <div class="col-4">
                                <?php if ($value['profile']) { ?>
                                    <img src="<?= file_url($value['profile']) ?>" alt="" class="user-avatar">
                                <?php } else { ?>
                                    <img src="<?= exit_url('assets/images/empty-profile-picture.jpg') ?>" alt="" class="user-avatar">
                                <?php } ?>
                            </div>
                            <div class="col-8">
                                <h6 class="text-capitalize pt-2"><?= $value['name'] ?></h6>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</div>