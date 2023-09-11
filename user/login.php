<?php
require_once("config/config.php");
require_once("config/db.php");

$title = "Login";
require_once('include/header.php');

if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'Login') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $check = $obj->Query("SELECT * from users where email = '$username' and password = '$password'");
        if ($check) {
            $check = $check[0];
            session_start();
            $_SESSION['u_id'] = $check->id;
            $_SESSION['user-status'] = "userLoggedIn";
            $_SESSION['username'] = $check->name;
            echo "<script>window.location.href='" . exit_url() . "'</script>";
        } else {
            echo "<script>alert('Invalid username or password');</script>";
            echo "<script>window.location.href='" . base_url('login.php') . "'</script>";
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

    .submit-btn {
        background-color: #008ecb;
        color: #fff;
    }

    .submit-btn:hover {
        background-color: #008ecb;
        color: #fff;
    }
</style>

<section class="sect-login">
    <div class="container">
        <div class="row justify-content-center d-flex flex-column  align-items-center min-vh-100">
            <div class="col-lg-5 bg-white">
                <form action="" method="POST">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="assets/images/logo.png" alt="logo.png">
                        </div>
                        <span  class="text-primary cursor-pointer"><a href="<?= exit_url('') ?>"><i class="fa fa-chevron-circle-left bg-primary text-white rounded-circle"></i>Back</a></span>
                        <div class="mt-4">
                            <div class="form-group mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="Enter your email">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                            </div>

                            <button type="submit" name="submit" class="btn submit-btn" value="Login">Login</button>
                            <p class="mt-2">Don't have an account? <a href="<?= base_url('register.php') ?>" class="text-primary">Create Account</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>

<?php
require_once('include/footer.php'); ?>