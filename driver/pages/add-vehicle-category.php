<?php

//insert
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'addVehicle') {
        $imgName = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $location = '../uploads' . '/' . $imgName;

        move_uploaded_file($tmp_name, $location);
        $_POST['image'] = $imgName;

        $check = $obj->select('category', '*', 'vname', array($_POST['vname']));

        if ($check) {
            echo "<script>alert('Vehicle already exists!');</script>";
            echo "<script>window.location.href='" . base_url('add-vehicle-category.php') . "'</script>";
        } else {
            unset($_POST['submit']);
            $aaa = $obj->insert('category', $_POST);
            if ($aaa) {
                echo "<script>alert('New Vehicle category added');</script>";
            } else {
                echo "<script>alert('Error adding Vehicle!');</script>";
                echo "<script>window.location.href='" . base_url('add-vehicle-category.php') . "'</script>";
            }
        }
    }
}

///delete
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'd') {
        $bbb = $obj->delete('category', 'id', array($_GET['id']));

        if ($bbb) {
            echo "<script>alert('Vehicle deleted!');</script>";
            echo "<script>window.location.href='" . base_url('add-vehicle-category.php') . "'</script>";
        } else {
            echo "<script>alert('Error deleting Vehicle!');</script>";
            echo "<script>window.location.href='" . base_url('add-vehicle-category.php') . "'</script>";
        }
    }
}

// update
if (isset($_POST['update'])) {
    if ($_POST['update'] == 'updateVehicle') {
        if ($_FILES['image']['name'] != '') {
            $imgName = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $location = '../uploads' . '/' . $imgName;
            move_uploaded_file($tmp_name, $location);
            $_POST['image'] = $imgName;
        }

        unset($_POST['update']);

        $a = $obj->update("category", $_POST, 'id', array($_POST['id']));
        if ($a) {
            echo "<script>alert('Vehicle category updated successfully');</script>";
            echo "<script>window.location.href='" . base_url('add-vehicle-category.php') . "'</script>";
        }
    }
}

$vehicles = $obj->select('category');


?>


<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-end my-2">
                <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Add new category</button>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
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
                                    <label for="vname">Vehicle Name</label>
                                    <input type="text" class="form-control" name="vname" id="vname">
                                </div>


                                <div class="form-group">
                                    <label for="image">Image/Thumbnail</label>
                                    <input type="file" class="form-control" name="image" id="image">
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
    </div>
    <div class="col-sm-12">

        <table class="table table-responsive-lite table-hover">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Vehicle Name</th>
                    <th>Category</th>
                    <th colspan="3" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehicles as $key => $value) : ?>
                    <tr>
                        <th scope="row"><?= ++$key; ?></th>
                        <td><?= $value['vname'] ?></td>
                        <td>
                            <a href="<?= file_url($value['image']) ?>"><img src="<?= file_url($value['image']) ?>" class="img-thumbnail" style="width:100px;height:50px" alt="<?= $value['vname'] ?>"></a>

                        </td>

                        <td> <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_details<?= $value['id'] ?>"><i class="fa fa-edit"></i>
                            </button>

                            <div class="modal fade" id="edit_details<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $value['id'] ?>">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Vehicle</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="vname">Vehicle Name</label>
                                                    <input type="text" class="form-control" name="vname" required value="<?= $value['vname'] ?>" id="vname">
                                                </div>


                                                <div class="form-group">
                                                    <label for="image">Image/Thumbnail</label>
                                                    <input type="file" class="form-control" name="image" id="image">
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
                        <td><a href="<?= base_url('add-vehicle-category.php?action=d&id=' . $value['id']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
</div>