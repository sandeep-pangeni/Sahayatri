<?php
ob_start();
session_start();
if ($_SESSION['ad-status']!="loggedin") {
	header("Location:login.php");
	exit();
}
require_once("config/config.php");
require_once ("config/db.php");
// require_once ("includes/controller-function.php");

$title = "VRS |Admin";
$url = isset($_GET['url']) ? $_GET['url'] : 'dashboard';
$url = str_replace('.php', '', $url);

$title2 = ucfirst($url);
$page = $title2;

$url .= '.php';

$pagePath = root('pages/' . $url);
require_once root('includes/header.php');
include root('includes/navbar.php');
require_once root('includes/sidebar.php');
if (file_exists($pagePath) && is_file($pagePath)) { ?>
    <?php require_once root('includes/breadcumb.php');
    ?>

    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <?php
                require_once $pagePath;
                ?>
            </div>
        </div>
    </div>
<?php } else { ?>
    <?php require_once root('404.php');   ?>
<?php } {
    require_once root('includes/footer.php');
}
?>