<?php
$update_cata = $obj->select('category', '*', 'id', array($_GET['id']));

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

        $a = $obj->update("category", $_POST, 'id', array($_GET['id']));
        if ($a) {
            echo "<script>alert('Vehicle category updated successfully');</script>";
            echo "<script>window.location.href='" . base_url('add-vehicle-category.php') . "'</script>";
        }
    }
}


?>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <form action="" method="POST" enctype="multipart/form-data" onsubmit="return updateValidateCat();">
                <div class="card card-body">
                    <div class="form-group">
                        <label class="font-weight-bold" for="vname_up">Vehicle</label>
                        <input type="text" class="form-control" name="vname" required value="<?= $update_cata['0']['vname'] ?>" pattern="([A-z0-9À-ž\s]){3,15}" id=" vname_up">
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold" for="thumb_up">Image/Thumbnail</label>
                        <div>
                            <a href="<?= file_url($update_cata['0']['image']) ?>"><img src="<?= file_url($update_cata['0']['image']) ?>" style="width:100px;height:80px" alt="<?= $value['vname'] ?>"></a>

                        </div>

                        <input type="file" class="form-control" name="image" id="image" onchange="updateFileValidation();">
                    </div>
                    <div class="card-footer mt-0 border-0">
                        <button type="button" class="btn btn-secondary" onclick="history.back();">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="update" value="updateVehicle">Update</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


<script>
    function updateFileValidation() {
        var fileInput = document.getElementById('image');

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