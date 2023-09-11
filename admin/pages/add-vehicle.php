<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php

//add vehicle
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'addVehicle') {
        $vname = metaphone($_POST['brand']);
        $vdescription = metaphone($_POST['description']);

        $_POST['index_search'] = $vname ." ". $vdescription ;
        
        if ($_POST['price'] > 10000) {
            $_SESSION['priceError'] = "Price/day is limited to Rs.10000";
        ?>
            <script>
                $(window).on('load', function() {
                    var delayMs = 100; // delay in milliseconds
                    setTimeout(function() {
                        $('#exampleModal').modal('show');
                    }, delayMs);
                });
            </script>
        <?php  } else if ($_POST['price'] < 0) {
            $_SESSION['priceError'] = "Price cannot be negative!"; ?>
            <script>
                $(window).on('load', function() {
                    var delayMs = 100; // delay in milliseconds
                    setTimeout(function() {
                        $('#exampleModal').modal('show');
                    }, delayMs);
                });
            </script>

^[A-Za-z]{1,3}[ -][0-9]{1,2}[ ][A-Za-z]{1,4}[ ][0-9]{1,4}$
        <?php } elseif (!preg_match('/^[A-Za-z]{1,3}[ -][0-9]{1,2}[ ][A-Za-z]{1,4}[ ][0-9]{1,4}$/', $_POST['v_no'])) {
            $_SESSION['vehicle_no_Error'] = "Please enter valid vehicle number.";
        ?>
            <script>
                $(window).on('load', function() {
                    var delayMs = 100; // delay in milliseconds
                    setTimeout(function() {
                        $('#exampleModal').modal('show');
                    }, delayMs);
                });
            </script>
        <?php  } elseif ($_POST['seat'] < 2) {
            $_SESSION['seat_Error'] = "Minimum seat capacity is 2 and maximum is 45";
        ?>
            <script>
                $(window).on('load', function() {
                    var delayMs = 100; // delay in milliseconds
                    setTimeout(function() {
                        $('#exampleModal').modal('show');
                    }, delayMs);
                });
            </script>
<?php } else {
            $imgName = $_FILES['photo']['name'];
            $tmp_name = $_FILES['photo']['tmp_name'];
            $location = '../uploads' . '/' . $imgName;

            move_uploaded_file($tmp_name, $location);
            $_POST['photo'] = $imgName;

            $check = $obj->select('vehicles', '*', 'v_no', array($_POST['v_no']));

            if ($check) {
                echo "<script>alert('Vehicle already exists!');</script>";
                echo "<script>window.location.href='" . base_url('add-vehicle.php') . "'</script>";
            } else {
                unset($_POST['submit']);
                $aaa = $obj->insert('vehicles', $_POST);
                if ($aaa) {
                    echo "<script>alert('New Vehicle added');</script>";
                    echo "<script>window.location.href='" . base_url('add-vehicle.php') . "'</script>";
                } else {
                    echo "<script>alert('Error adding Vehicle!');</script>";
                    echo "<script>window.location.href='" . base_url('add-vehicle.php') . "'</script>";
                }
            }
        }
    }
}

// update
if (isset($_POST['update'])) {
    if ($_POST['update'] == 'updateVehicle') {
        if ($_FILES['photo']['name'] != '') {
            $imgName = $_FILES['photo']['name'];
            $tmp_name = $_FILES['photo']['tmp_name'];
            $location = '../uploads' . '/' . $imgName;
            move_uploaded_file($tmp_name, $location);
            $_POST['photo'] = $imgName;
        }
        unset($_POST['update']);

        $aaaa = $obj->update("vehicles", $_POST, 'id', array($_POST['id']));
        if ($aaaa) {
            echo "<script>alert('Vehicle updated successfully');</script>";
            echo "<script>window.location.href='" . base_url('add-vehicle.php') . "'</script>";
        } else {
            echo "<script>alert('Error updating vehicle!');</script>";
            echo "<script>window.location.href='" . base_url('add-vehicle.php') . "'</script>";
        }
    }
}

///delete
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'd') {
        $bbb = $obj->delete('vehicles', 'id', array($_GET['id']));

        if ($bbb) {
            echo "<script>alert('Vehicle deleted!');</script>";
            echo "<script>window.location.href='" . base_url('add-vehicle.php') . "'</script>";
        } else {
            echo "<script>alert('Error deleting Vehicle!');</script>";
            echo "<script>window.location.href='" . base_url('add-vehicle.php') . "'</script>";
        }
    }
}



$category = $obj->select('category');

$list_vehicles = $obj->select('vehicles', '*', '', array(), ' ORDER BY id desc');


?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-end my-2">
                <button class="btn btn-outline-dark" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Add new vehicle</button>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Vehicle</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <select class="form-control border border-secondary" name="category" id="category" required>
                                        <option value="" selected> Choose a vehicle category</option>
                                        <?php foreach ($category as $key => $value) : ?>
                                            <option value="<?= $value['id'] ?>" <?php if (isset($_POST['category'])) {
                                                                                    if ($_POST['category'] == $value['id']) { ?> selected <?php }
                                                                                                                                    } ?>><?= $value['vname'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="brand">Vehicle Brand/Model</label>
                                    <input type="text" class="form-control" name="brand" id="brand" <?php if (isset($_POST['brand'])) { ?> value="<?= $_POST['brand'] ?>" <?php } ?> required pattern="^[a-zA-Z0-9_ ]*$">
                                </div>

                                <div class="form-group">
                                    <label for="price">Price (per day)</label>
                                    <input type="number" class="form-control" name="price" id="price" <?php if (isset($_POST['price'])) { ?> value="<?= $_POST['price'] ?>" <?php } ?> required>
                                    <?php if (isset($_SESSION['priceError'])) { ?>
                                        <span class="text-danger">
                                            <?php echo $_SESSION['priceError'];
                                            unset($_SESSION['priceError']);  ?>
                                        </span>
                                    <?php }  ?>
                                </div>

                                <div class="form-group">
                                    <label for="v_no">Vehicle No</label>
                                    <input type="text" class="form-control" name="v_no" id="v_no" <?php if (isset($_POST['v_no'])) { ?> value="<?= $_POST['v_no'] ?>" <?php } ?> required>
                                    <?php if (isset($_SESSION['vehicle_no_Error'])) { ?>
                                        <span class="text-danger">
                                            <?php echo $_SESSION['vehicle_no_Error'];
                                            unset($_SESSION['vehicle_no_Error']);  ?>
                                        </span>
                                    <?php }  ?>
                                </div>

                                <div class="form-group">
                                    <label for="photo">Vehicle Photo</label>
                                    <input type="file" class="form-control" name="photo" id="photo" required onchange="return addFileValidation();">
                                </div>

                                <div class="form-group">
                                    <label for="seat">Seat/Capacity</label>
                                    <input type="number" class="form-control" name="seat" id="seat" required <?php if (isset($_POST['seat'])) { ?> value=<?= $_POST['seat'] ?> <?php } ?>>
                                    <?php if (isset($_SESSION['seat_Error'])) { ?>
                                        <span class="text-danger">
                                            <?php echo $_SESSION['seat_Error'];
                                            unset($_SESSION['seat_Error']);  ?>
                                        </span>
                                    <?php }  ?>
                                </div>

                                <div class="form-group">
                                    <label for="description">Overview/Description</label>
                                    <textarea class="form-control" rows="4" name="description" id="description"><?php if(isset($_POST['description'])) { ?><?=$_POST['description'] ?> <?php } ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit" value="addVehicle">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <h4>Vehicles List</h4>

            <?php if ($list_vehicles) { ?>
                <table class="table table-responsive-lite table-hover">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th class="text-nowrap">Vehicle</th>
                            <th>Category</th>
                            <th class="text-nowrap">Price(Per day)</th>
                            <th>Image</th>

                            <th colspan="2" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_vehicles as $key => $value) : ?>
                            <tr>
                                <th scope="row"><?= ++$key; ?></th>
                                <td><?= $value['brand'] ?> <br>(<?= $value['v_no'] ?>)</td>
                                <td>
                                    <?php
                                    $catag_quer = $obj->select('category', '*', 'id', array($value['category']));
                                    $category_name = $catag_quer[0]['vname'];
                                    ?>
                                    <?= $category_name ?></td>
                                <td>Rs.<?= $value['price'] ?></td>
                                <td>
                                    <a href="<?= file_url($value['photo']) ?>"><img src="<?= file_url($value['photo']) ?>" class="border border-secondary" style="width:100px;height:50px" alt="<?= $category_name ?> - <?= $value['v_no'] ?> "></a>

                                </td>
                                <td><a href="<?= base_url('vehicle-details.php?id=' . $value['id']) ?>" class="btn btn-light btn-sm"><i class="fa  fa-eye"></i> View</a></td>

                                <td> <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#update_details<?= $value['id'] ?>"><i class="fa fa-edit"></i> Edit
                                    </button>

                                    <div class="modal fade updateModel" id="update_details<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?= $value['id'] ?>">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Vehicle Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Vehicle Model/Brand</label>
                                                            <input type="text" class="form-control" name="brand" value="<?= $value['brand'] ?>" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="price">Vehicle Price</label>
                                                            <input type="number" class="form-control" name="price" value="<?= $value['price'] ?>" required pattern="^.{500,10000}$">

                                                        </div>

                                                        <div class="form-group">
                                                            <label for="photo">Vehicle Photo</label>
                                                            <input type="file" class="form-control" name="photo" id="photo">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="description">Overview/Description</label>
                                                            <textarea class="form-control" rows="4" name="description" id="description"><?= $value['description'] ?></textarea>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="update" value="updateVehicle">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="<?= base_url('add-vehicle.php?action=d&id=' . $value['id']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <h5 class="text-danger text-center p-3">No vechiles added!</h5><?php } ?>
        </div>
    </div>
</div>

<script>
    function addFileValidation() {
        var fileInput = document.getElementById('photo');

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
</script>