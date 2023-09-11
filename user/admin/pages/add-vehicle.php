<?php
//insert
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'addVehicle') {
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
            } else {
                echo "<script>alert('Error adding Vehicle!');</script>";
                echo "<script>window.location.href='" . base_url('add-vehicle.php') . "'</script>";
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
        }
        else{
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

$list_vehicles = $obj->select('vehicles');


?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-end my-2">
                <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Add new vehicle</button>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
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
                                            <option value="<?= $value['id'] ?>"><?= $value['vname'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="brand">Vehicle Brand/Model</label>
                                    <input type="text" class="form-control" name="brand" id="brand">
                                </div>

                                <div class="form-group">
                                    <label for="price">Price (per day)</label>
                                    <input type="number" class="form-control" name="price" id="price">
                                </div>


                                <div class="form-group">
                                    <label for="v_no">Vehicle No</label>
                                    <input type="text" class="form-control" name="v_no" id="v_no" placeholder="Ex. Ba 2 Kha 3978" required>
                                </div>

                                <div class="form-group">
                                    <label for="photo">Vehicle Photo</label>
                                    <input type="file" class="form-control" name="photo" id="photo" required>
                                </div>

                                <div class="form-group">
                                    <label for="seat">Seat/Capacity</label>
                                    <input type="number" class="form-control" name="seat" id="seat" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Overview/Description</label>
                                    <textarea class="form-control" rows="4" name="description" id="description"></textarea>
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
            <?php if ($list_vehicles) { ?>
                <table class="table table-responsive-lite table-hover">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th class="text-nowrap">Vehicle Model/Brand</th>
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
                                <td><?= $value['brand'] ?></td>
                                <td>
                                    <?php
                                    $catag_quer = $obj->select('category', '*', 'id', array($value['category']));
                                    $category_name = $catag_quer[0]['vname'];
                                    ?>
                                    <?= $category_name ?></td>
                                <td>Rs.<?= $value['price'] ?></td>
                                <td>
                                    <a href="<?= file_url($value['photo']) ?>"><img src="<?= file_url($value['photo']) ?>" class="img-thumbnail" style="width:100px;height:50px" alt="<?= $category_name ?> - <?= $value['v_no'] ?> "></a>

                                </td>
                                <td><a href="<?= base_url('vehicle-details.php?id=' . $value['id']) ?>" class="btn btn-light btn-sm"><i class="fa  fa-eye"></i> View</a></td>

                                <td> <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#update_details<?= $value['id'] ?>"><i class="fa fa-edit"></i> Edit
                                    </button>

                                    <div class="modal fade" id="update_details<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                            <input type="number" class="form-control" name="  price" required value="<?= $value['price'] ?>" id="price">
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