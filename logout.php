<?php 
include './config.php'; 
unset($_SESSION['isLoggedIn']);
unset($_SESSION['isAdmin']);
unset($_SESSION['user']);
$_SESSION['msg'] = "User logged out successfully";
header('location: '.SITE_WS_PATH.'login.php');
exit;

