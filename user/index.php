<?php
ob_start();
session_start();
if ($_SESSION['user-status']!="userLoggedIn") {
	header("Location:login.php");
	exit();
}
require_once("config/config.php");
require_once("config/db.php");
// require_once ("includes/controller-function.php");

$title = "VRS";
$url = isset($_GET['url']) ? $_GET['url'] : 'dashboard';
$url = str_replace('.php', '', $url);

// user id 
$uid = $_SESSION['u_id'];
$loggedInUser = $_SESSION['username'];

$title2 = ucfirst($url);
$page = $title2;

$url .= '.php';

$pagePath = root('pages/' . $url);
require_once('include/header.php');
require_once('include/sidebar.php');
require_once('include/navbar.php');
if (file_exists($pagePath) && is_file($pagePath)) { ?>
  <!-- page content -->
  <div class="right_col" role="main">
    <?php
    require_once root('include/breadcumb.php');
    require_once $pagePath;
    ?></div>
  <!-- /page content -->

<?php } else { ?>
  <?php require_once root('page_404.php');   ?>
<?php } {
  require_once root('include/footer.php');
}
?>