<?php session_start(); ?>
<?php require 'config.php'; ?>
<?php
$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
if(!$conn){
  die("Not connected to Database");
}
?>
<?php require 'header.php'; ?>
<div class="container main-container">
  <div class="row">
    <?php $result = mysqli_query($conn, "select * from users");
          $n = mysqli_num_rows($result);
     ?>
    <h2>Users(<?php echo $n;?>)</h2>
    <?php while ($row = mysqli_fetch_array($result)) { ?>
      <div class="col-md-3 col-md-offset-1 alert alert-info">
       <h3><span class="glyphicon glyphicon-user"> </span> <?php echo $row['username']; ?></h3>
       <p><strong>Member Since: </strong> <?php echo $row['registered_at']; ?></p>
       <p><strong>Email: </strong> <?php echo $row['email']; ?></p>
      </div>
  <?php  } ?>
  </div>
</div>
<?php require 'footer.php'; ?>
