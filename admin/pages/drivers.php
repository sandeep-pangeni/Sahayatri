<?php
//insert
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'addDriver') {
        $imgName = $_FILES['license_photo']['name'];
        $tmp_name = $_FILES['license_photo']['tmp_name'];
        $location = '../uploads' . '/' . $imgName;

        move_uploaded_file($tmp_name, $location);
        $_POST['license_photo'] = $imgName;

        $checkEmail = $obj->select('drivers', '*', 'email', array($_POST['email']));
        // $checkCategory = $obj->select('drivers', '*', 'v_category', array($_POST['v_category']));
        $checkLicense = $obj->select('drivers', '*', 'license_no', array($_POST['license_no']));

        if ($checkEmail || $checkLicense) {
            echo "<script>alert('Error! Driver already exists!');</script>";
        } else {
            unset($_POST['submit']);
            $aaa = $obj->insert('drivers', $_POST);
            if ($aaa) {
                echo "<script>alert('New driver added');</script>";
                echo "<script>window.location.href='" . base_url('drivers.php') . "'</script>";
            } else {
                echo "<script>alert('Error adding driver!');</script>";
                echo "<script>window.location.href='" . base_url('drivers.php') . "'</script>";
            }
        }
    }
}

// update
if (isset($_POST['update'])) {
    if ($_POST['update'] == 'updateDriver') {
        if ($_FILES['license_photo']['name'] != '') {
            $imgName = $_FILES['license_photo']['name'];
            $tmp_name = $_FILES['license_photo']['tmp_name'];
            $location = '../uploads' . '/' . $imgName;
            move_uploaded_file($tmp_name, $location);
            $_POST['license_photo'] = $imgName;
        }

        unset($_POST['update']);

        $aaaa = $obj->update("drivers", $_POST, 'id', array($_POST['id']));
        if ($aaaa) {
            echo "<script>alert('Driver updated successfully');</script>";
            echo "<script>window.location.href='" . base_url('drivers.php') . "'</script>";
        } else {
            echo "<script>alert('Error updating driver!');</script>";
            echo "<script>window.location.href='" . base_url('drivers.php') . "'</script>";
        }
    }
}


///delete
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'd') {
        $bbb = $obj->delete('drivers', 'id', array($_GET['id']));

        if ($bbb) {
            echo "<script>alert('Driver deleted!');</script>";
            echo "<script>window.location.href='" . base_url('drivers.php') . "'</script>";
        } else {
            echo "<script>alert('Error deleting driver!');</script>";
            echo "<script>window.location.href='" . base_url('drivers.php') . "'</script>";
        }
    }
}

$category = $obj->select('category');

$drivers_list = $obj->select('drivers', '*', '', array(), ' ORDER BY id desc');

?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-end my-2">
                <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-plus"></i> Add new driver</button>
                <a href="https://applydl.dotm.gov.np/license-check" target="_blank" class="btn btn-success mx-2"><i class="fas fa-check"></i> Verify License</a>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg shadow" role="document">
                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off" onsubmit="return validateDriver()">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Driver</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">Driver Name</label>
                                            <input type="text" class="form-control" name="name" id="dname" required>
                                            <span id="nameError" class="text-danger"></span>

                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" name="address" id="daddress" required>
                                            <span id="addrError" class="text-danger"></span>
                                        </div>


                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="number" class="form-control" name="phone" id="dphone" required>
                                            <span id="phError" class="text-danger"></span>
                                        </div>

                                        <div style="background:#f0f0f0;padding:8px">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" name="email" id="demail" required>
                                                <span id="emailError" class="text-danger"></span>

                                            </div>


                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" name="password" id="password" required>
                                                <span id="passError" class="text-danger"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="c_password">Confirm Password</label>
                                                <input type="password" class="form-control" id="c_password" required>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="v_category">Vehicle Type?</label>
                                            <select class="form-control border border-secondary" name="v_category" id="v_category" required>
                                                <option value="" selected> Choose a vehicle category</option>
                                                <?php foreach ($category as $key => $value) : ?>
                                                    <option value="<?= $value['id'] ?>" class="text-capitalize"><?= $value['vname'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="rate">Rate(per day)</label>
                                            <input type="number" class="form-control" name="rate" id="drate" required>
                                            <span id="rateError" class="text-danger"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="license_no">License No</label>
                                            <input type="text" class="form-control" name="license_no" id="license_no" placeholder="Ex. 01-08-674564" required>
                                            <span id="licenseNoError" class="text-danger"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="license_photo">License Photo</label>
                                            <input type="file" class="form-control" name="license_photo" onchange="return filedriverValidation();" id="dlicense_photo" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit" value="addDriver">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <h4>Drivers List</h4>
            <?php if ($drivers_list) { ?>
                <table class="table table-responsive-lite table-hover">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th class="text-nowrap">Driver Name</th>
                            <th>Addrress</th>
                            <th>Phone No.</th>
                            <th>Category</th>
                            <th class="text-nowrap">Rate (Per day)</th>

                            <th colspan="2" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($drivers_list as $key => $value) : ?>
                            <tr>
                                <th scope="row"><?= ++$key; ?></th>
                                <td><?= $value['name'] ?></td>
                                <td><?= $value['address'] ?></td>
                                <td><?= $value['phone'] ?></td>
                                <td>
                                    <?php
                                    $catag_quer = $obj->select('category', '*', 'id', array($value['v_category']));
                                    $category_name = $catag_quer[0]['vname'];
                                    ?>
                                    <?= $category_name ?></td>
                                <td>Rs.<?= $value['rate'] ?></td>

                                <td><a href="<?= base_url('driver-details.php?id=' . $value['id']) ?>" class="btn btn-light btn-sm"><i class="fa  fa-eye"></i> View Details</a></td>

                                <td> <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#update_details<?= $value['id'] ?>"><i class="fa fa-edit"></i> Edit
                                    </button>

                                    <div class="modal fade" id="update_details<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?= $value['id'] ?>">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Driver Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Driver Name</label>
                                                            <input type="text" class="form-control" name="name" value="<?= $value['name'] ?>" id="dname" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="address">Address</label>
                                                            <input type="text" class="form-control" name="address" required value="<?= $value['address'] ?>" id="daddress">
                                                            <span id="addrError" class="text-danger"></span>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone">Phone No.</label>
                                                            <input type="number" class="form-control" name="phone" required value="<?= $value['phone'] ?>" id="dphone">
                                                            <span id="phError" class="text-danger"></span>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="text" class="form-control" name="email" required value="<?= $value['email'] ?>" id="demail">
                                                            <span id="emailError" class="text-danger"></span>

                                                        </div>

                                                        <div class="form-group">
                                                            <label for="rate">Rate(Per day)</label>
                                                            <input type="number" class="form-control" name="rate" required value="<?= $value['rate'] ?>" id="drate">
                                                            <span id="rateError" class="text-danger"></span>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="license_no">License No.</label>
                                                            <input type="text" class="form-control" name="license_no" required value="<?= $value['license_no'] ?>" id="dlicense">

                                                        </div>

                                                        <div class="form-group">
                                                            <label for="license_photo">License photo</label>
                                                            <input type="file" class="form-control" name="license_photo" required id="license_photo" onchange="return fileValidation();">
                                                            <span id="licensePhotoError" class="text-danger"></span>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="update" value="updateDriver">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="<?= base_url('drivers.php?action=d&id=' . $value['id']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <h5 class="text-danger text-center p-3">No Driver added!</h5><?php } ?>
        </div>
    </div>
</div>

<script>
    function filedriverValidation() {
        var fileInput = document.getElementById('dlicense_photo');

        var filePath = fileInput.value;

        // Allowing file type
        var allowedExtensions =
            /(\.jpg|\.jpeg|\.png|\.tiff|\.psd)$/i;

        if (!allowedExtensions.exec(filePath)) {
            alert('Unsupported file type. Please choose only images');
            fileInput.value = '';
            return false;
        } else {

            // Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(
                            'imagePreview').innerHTML =
                        '<img src="' + e.target.result +
                        '" class="preview-img"/>';
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }

    function validateDriver() {
        var name = document.getElementById('dname').value;
        var address = document.getElementById('daddress').value;
        var phone = document.getElementById('dphone').value;
        var email = document.getElementById('demail').value;
        var rate = document.getElementById('drate').value;
        var licenseNo = document.getElementById('license_no').value;
        var a = document.getElementById('password').value;
        var b = document.getElementById('c_password').value;

        //name validation
        var regName = /^(([A-Za-z]+[\-\']?)*([A-Za-z]+)?\s)+([A-Za-z]+[\-\']?)*([A-Za-z]+)?$/;
        if (!regName.test(name)) {
            document.getElementById("nameError").innerHTML = "Invalid name. Please enter valid name.";
            return false;
        } else {
            document.getElementById("nameError").innerHTML = "";
        }

        //address
        var regexAddr = /^[a-z0-9\s,'-]*$/i;
        if (!regexAddr.test(address)) {
            document.getElementById('addrError').innerHTML = "Please enter valid address!";
            return false;
        }

        //email validation
        var checkWhatIsAfterAt = email.substring(email.indexOf('@') + 1);
        var checkWhatIsBeforeAt = email.split('@')[0];
        var isGmail = "gmail.com";
        var isOutlook = "outlook.com";
        var isYahoo = "yahoo.com";
        var isIcloud = "icloud.com";
        var isInbox = "inbox.com";
        var isMail = "mail.com"

        const eeemail = [isGmail, isOutlook, isYahoo, isIcloud, isInbox, isMail];

        checkEmail = eeemail.includes(checkWhatIsAfterAt);

        if (!checkEmail) {
            document.getElementById("emailError").innerHTML = "Please enter valid mail!";
            return false;
        } else {
            document.getElementById("emailError").innerHTML = "";
        }

        var letters = /^[0-9.A-Za-z]+$/;
        if (checkWhatIsBeforeAt.match(letters)) {} else {
            document.getElementById("emailError").innerHTML = "Email cannot consist special letters";
            return false;
        }

        if (phone == '') {
            document.getElementById("phError").innerHTML = "Phone number is required!";
            return false;
        } else if (phone.startsWith("96") || phone.startsWith("97") || phone.startsWith("98")) {
            if (phone.length !== 10) {
                document.getElementById("phError").innerHTML = "Phone number must be exactly 10 digits!";
                return false;
            }
        } else {
            document.getElementById("phError").innerHTML = "Invalid phone number";
            return false;
        }

        if (rate < 500) {
            document.getElementById("rateError").innerHTML = "Minimum rate is Rs. 500";
            return false;
        } else if (rate > 3000) {
            document.getElementById("rateError").innerHTML = "Maximim driver rate per day is Rs. 3000";
            return false;
        }


        var lcsRegex = /^[0-9 -]+$/;
        if (licenseNo.match(lcsRegex)) {} else {
            document.getElementById("licenseNoError").innerHTML = "Invalid License Number";
            return false;
        }

        if (a !== b) {
            document.getElementById('passError').innerHTML = "Password does not match!";
            return false;
        }


    }
</script>