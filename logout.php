<?php
session_start();
unset($_SESSION['user_loggedin']);
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
header("location:index.php");
?>
