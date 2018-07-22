<?php
session_start();
// check user login
if(!isset($_SESSION['user_loggedin'])){
  header("location:login.php");
}
require 'config.php';
$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
if(!$conn){
  die("Not connected to Database");
}

if(isset($_GET['q_id'])){
  $id = $_GET['q_id'];
  $sql = "delete from questions where id='$id'";
  mysqli_query($conn , $sql);
  header("location:questions.php");
  die();
}
?>
