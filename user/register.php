<?php
require_once("config/config.php");
require_once("config/db.php");

$title = "Register";
require_once('include/header.php');

if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'Register') {
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $check = $obj->Query("SELECT * from users where email = '$email' or phone = '$phone'");
        if ($check) {
            echo "<script>alert('Account already exists!');</script>";
            echo "<script>window.location.href='" . base_url('register.php') . "'</script>";
        } else {
            $imgName = $_FILES['profile']['name'];
            $tmp_name = $_FILES['profile']['tmp_name'];
            $location = 'uploads' . '/' . $imgName;
            move_uploaded_file($tmp_name, $location);
            $_POST['profile'] = $imgName;
            unset($_POST['submit']);
            $zz = $obj->insert('users', $_POST);
            if ($zz) {
                echo "<script>alert('Account created successfully');</script>";
                echo "<script>window.location.href='" . base_url('login.php') . "'</script>";
            }
        }
    }
}
?>

<style>
    body {
        background-color: #e9e9e9;
    }

    label {
        font-size: 1rem;
        font-weight: 600;
    }

    label span{
        color:red;

    }
    .submit-btn {
        background-color: #008ecb;
        color: #fff;
    }

    .submit-btn:hover {
        background-color: #008ecb;
        color: #fff;
    }

    .d-file-preview .preview-img {
        width: 130px;
        height: 100px;
    }
</style>

<section class="sect-login">
    <div class="container">
        <div class="row justify-content-center d-flex flex-column align-items-center min-vh-100">
            <div class="col-lg-5 bg-white d-file-preview">
                <form action="" method="POST" onsubmit="return validate();" enctype="multipart/form-data">
                    <div class="card-body">
                        <span onclick="history.back();" class="text-dark cursor-pointer"><i class="fa fa-chevron-circle-left bg-dark text-white rounded-circle"></i>Back</span>
                        <hr>
                        <div class="text-center">
                            <img src="assets/images/logo.png" alt="logo.png" class="img-fluid">
                        </div>

                        <div class="mt-4">
                            <div class="form-group mb-3">
                                <label for="username">Full Name<span>*</span></label>
                                <input type="text" name="name" class="form-control" id="fullname" placeholder="Enter your fulll name">
                                <span class="text-danger" id="nameError"></span>
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email<span>*</span></label>
                                <input type="email" name="email" class="form-control" id="email">
                                <span class="text-danger" id="emailError"></span>

                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="address">Address<span>*</span></label>
                                        <input type="text" name="address" class="form-control" id="address">
                                        <span class="text-danger" id="addrError"></span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="phone">Phone<span>*</span></label>
                                        <input type="number" name="phone" class="form-control" id="phone">
                                        <span class="text-danger" id="phError"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="profile">Profile<span>*</span></label>
                                <input type="file" name="profile" class="form-control" id="profile" onchange="return fileValidation()" required />
                                <div id="imagePreview"></div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Password<span>*</span></label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>

                            <div class="form-group mb-3">
                                <label for="cpassword">Confirm password<span>*</span></label>
                                <input type="password" class="form-control" id="cpassword">
                                <span id="passError" class="text-danger"></span>
                            </div>

                            <button type="submit" name="submit" class="btn submit-btn" value="Register">Register</button>
                            <p class="mt-2">Already have an account? <a href="<?= base_url('login.php') ?>" class="text-primary">Login</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    // function containsSpecialChars(str) {
    //     const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    //     return specialChars.test(str);
    // }

    function validate() {
        var a = document.getElementById('password').value;
        var b = document.getElementById('cpassword').value;
        var phone = document.getElementById('phone').value;
        var email = document.getElementById('email').value;
        var fullname = document.getElementById('fullname').value;
        var address = document.getElementById('address').value;

        //name validation
        var regName = /^[a-zA-Z]+ [a-zA-Z]+$/;
        if (!regName.test(fullname)) {
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

        if (a !== b) {
            document.getElementById('passError').innerHTML = "Password does not match!";
            return false;
        }
    }


    function fileValidation() {
        var fileInput = document.getElementById('profile');

        var filePath = fileInput.value;

        // Allowing file type
        var allowedExtensions =
            /(\.jpg|\.jpeg|\.png|\.gif)$/i;

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
<?php
require_once('include/footer.php'); ?>