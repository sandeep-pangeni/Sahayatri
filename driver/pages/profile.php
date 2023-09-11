<?php
$profile = $obj->select('drivers', '*', 'id', array($_GET['id']));
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'changePW') {
        $password = $_POST['password'];
        print_r($password);
        unset($_POST['submit']);
        $requestPwChange = $obj->Query("UPDATE drivers set password =  '$password' where id = $did");
        echo '<script>alert("Password changed!")</script>';
    }
}


// update
if (isset($_POST['addProfile'])) {
    if ($_FILES['profile']['name'] != '') {
        $imgName = $_FILES['profile']['name'];
        $tmp_name = $_FILES['profile']['tmp_name'];
        $location = 'uploads' . '/' . $imgName;
        move_uploaded_file($tmp_name, $location);
        $_POST['profile'] = $imgName;
    }
    unset($_POST['addProfile']);

    $aaaa = $obj->update("drivers", $_POST, 'id', array($_GET['id']));
    if ($aaaa) {
        echo "<script>alert('Profile updated successfully');</script>";
        echo "<script>window.location.href='" . base_url('profile.php?id=' . $_GET['id']) . "'</script>";
    } else {
        echo "<script>alert('Error updating Profile!');</script>";
        echo "<script>window.location.href='" . base_url('profile.phpid=' . $_GET['id']) . "'</script>";
    }
}

?>

<style>
    section {
        margin: 20px;
    }

    input::-webkit-file-upload-button {
        position: absolute;
        padding: 6px 10px;
        background-color: #fff;
        border: none;
        border-radius: 5px;
        color: #444;
        /* text-transform: uppercase; */
        transition: 100ms ease-out;
        cursor: pointer;
    }

    input::-webkit-file-upload-button:hover {
        background-color: #f0f0f0;
        box-shadow: 0px 3px 5px -1px rgba(0, 0, 0, 0.2), 0px 3px 4px 0px rgba(0, 0, 0, 0.14), 0px 1px 6px 0px rgba(0, 0, 0, 0.12)
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <div class="card mb-4">
                <div class="card-body d-flex">
                    <div style="max-width:150px !important;display:block;overflow:hidden">
                        <?php
                        if (empty($profile[0]['profile'])) { ?>
                            <div class="mt-3 alert alert-secondary">
                                <p class="text-danger">No profile</p>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group mb-4">
                                        <input type="file" name="profile" accept="image/*" id="upload" required/>
                                    </div>
                                    <button type="submit" name="addProfile" class="btn btn-info">Add</button>
                                </form>
                            </div>
                        <?php } else { ?>
                            <img src="<?= file_url($profile[0]['profile']) ?>" alt="avatar" class="rounded-circle img-fluid img-thumbnail" style="width: 130px;height:130px">
                            <div class="alert alert-secondary mt-3">
                                <h6>Update your profile</h6>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group mb-4">
                                        <input type="file" name="profile" accept="image/*" required/>
                                    </div>
                                    <button type="submit" name="addProfile" class="btn btn-info">Update</button>

                                </form>
                            </div>
                        <?php } ?>

                    </div>

                    <div class="text-left mx-3">
                        <h5 class="my-3"><?= $profile[0]['name'] ?></h5>
                        <p class="text-dark mb-1">
                            <?php
                            $profile_categ = $obj->select('category', '*', 'id', array($profile[0]['v_category']));
                            $driver_categ = $profile_categ[0]['vname']; ?>

                            <?= $driver_categ ?></p>

                        <strong>License No. : <?= $profile[0]['license_no'] ?></strong>

                        <div class="my-3">
                            <?php
                            for ($i = 0; $i < 4; $i++) { ?>
                                <i class="fas fa-star text-warning"></i>
                            <?php } ?>
                        </div>
                        <small class="d-block">(Based on 4+ ratings)</small>

                    </div>

                </div>
            </div>
        </div>
                        <div class="col-lg-7">
            <section>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link h6 active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Profile Details</a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link h6" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Change Password</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0 strong font-weight-bold">Full Name</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="h6 mb-0"><?= $profile[0]['name'] ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0 strong font-weight-bold">Email</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="h6 mb-0"><?= $profile[0]['email'] ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0 strong font-weight-bold">Phone</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="h6 mb-0"><?= $profile[0]['phone'] ?></p>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0 strong font-weight-bold">Address</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="h6 mb-0"><?= $profile[0]['address'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="my-2 card card-body">
                            <form action="" method="POST" onsubmit="return verifyPassword();">
                                <input type="hidden" name="password" id="op" value="<?= $profile[0]['password'] ?>">
                                <div class="form-group">
                                    <label for="">Old Password</label>
                                    <input type="password" class="form-control" placeholder="Enter your old password" id="old_pw" required>
                                    <span class="text-danger" id="oldPassError"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">New Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter your new password" id="new_pw" required>
                                    <span class="text-danger" id="matchOldAndNew"></span>

                                </div>

                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="Confirm Password" id="c_pw" required>
                                    <span class="text-danger" id="matchPassError"></span>
                                </div>
                        </div>

                        <button class="btn btn-primary px-2" type="submit" name="submit" value="changePW">Change</button>
                        </form>
                    </div>
                </div>
        </div>
        </section>
    </div>
</div>
</div>

<script>
    function verifyPassword() {
        var op = document.getElementById("op").value;
        var inputted_pw = document.getElementById("old_pw").value;
        var password = document.getElementById("new_pw").value;
        var confirmPassword = document.getElementById("c_pw").value;

        if (op !== inputted_pw) {
            document.getElementById('oldPassError').innerHTML = "Incorrect old password !"
            return false;
        } else {
            document.getElementById('oldPassError').innerHTML = "";
        }


        if (password != confirmPassword) {
            document.getElementById('matchPassError').innerHTML = "Password doesn't match!"
            return false;
        }
        return true;


        if (op === password) {
            document.getElementById('matchOldAndNew').innerHTML = "New password matches to old password"
            return false;
        } else {
            document.getElementById('matchOldAndNew').innerHTML = "";
        }

    }
</script>