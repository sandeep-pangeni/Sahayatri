<?php
ob_start();
session_start();
require_once('config/config.php');
require_once('config/db.php');

$title = "Sahayatri | A Vehicle Renting System";
require_once('includes/header.php');
require_once('includes/navbar.php');
require_once('pages/home.php');
?>

<?php require_once('includes/footer.php'); ?>
