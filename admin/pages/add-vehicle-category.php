<?php

//insert
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'addVehicle') {
        $vname = metaphone($_POST['vname']);
        $_POST['index_search'] = $vname;

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
                echo "<script>window.location.href='" . base_url('add-vehicle-category.php') . "'</script>";
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
        $chek = $obj->select('drivers', '*', 'v_category', array($_GET['id']));

        $chek2 = $obj->select('bookings', '*', 'category', array($_GET['id']));

        if ($chec || $chek2) {
            echo "<script>alert('Cannot delete! There are either drivers or bookings with this category.');</script>";
            echo "<script>window.location.href='" . base_url('add-vehicle-category.php') . "'</script>";
        } else {
            $bbb = $obj->delete('category', 'id', array($_GET['id']));
            if ($bbb) {
                echo "<script>alert('Vehicle deleted!');</script>";
                echo "<script>window.location.href='" . base_url('add-vehicle-category.php') . "'</script>";
            }
        }
    }
}

$vehicles = $obj->select('category', '*', '', array(), ' ORDER BY id desc');


?>


<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-end my-2">
                <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-plus"></i> Add new category</button>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateCat();">
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
                                    <input type="text" class="form-control" name="vname" id="vname" placeholder="Ex. Bus">
                                    <span id="catError" class="text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="thumb">Image/Thumbnail</label>
                                    <input type="file" class="form-control" name="image" id="thumb" onchange="fileValidation();" required>
                                </div>

                                <script>
                                    function validateCat() {
                                        var v_name = document.getElementById('vname').value;
                                        if (!v_name.match(/^[a-zA-Z | a-zA-Z ]+$/g)) {
                                            document.getElementById('catError').innerHTML = "Please enter valid name!";
                                            return false;
                                        } else {
                                            document.getElementById('catError').innerHTML = "";
                                        }
                                    }
                                </script>
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

        <table class="table table-responsive table-hover">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Vehicle Name</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehicles as $key => $value) : ?>
                    <tr>
                        <th scope="row"><?= ++$key; ?></th>
                        <td><?= $value['vname'] ?></td>
                        <td>
                            <a href="<?= file_url($value['image']) ?>"><img src="<?= file_url($value['image']) ?>" class="img-thumbnail" style="width:100px;height:80px" alt="<?= $value['vname'] ?>"></a>

                        </td>

                        <td> <a class="btn btn-outline-primary btn-sm" href="<?= base_url('update-category.php?id=' . $value['id']) ?>"><i class="fa fa-edit"></i>
                            </a>

                            <a href="<?= base_url('add-vehicle-category.php?action=d&id=' . $value['id']) ?>" class="btn btn-danger btn-sm mx-2" onclick="return confirm('Are you sure you want to delete this?')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<script>
    function fileValidation() {
        var fileInput = document.getElementById('thumb');

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