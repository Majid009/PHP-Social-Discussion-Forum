<?php
session_start();
require 'config.php';
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
if(!$conn) die("Not Connected to Database");

$message = "";

if( isset($_POST['email']) && isset($_POST['password']) ){
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "select * from users where email='$email' and password='$password'";
    $result = mysqli_query($conn, $sql);
    if( mysqli_num_rows($result) == 1){
      $row = mysqli_fetch_array($result);

      $_SESSION['user_loggedin'] = "OK";
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_name'] = $row['username'];

      header("location:profile.php");
    } else {
      $message = "<h3>Incorrect details ! try again </h3><br>";
    }
}

?>
<?php require 'header.php'; ?>
<div class="container main-container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h1 class="form_title">Login</h1>
      <?php echo $message; ?>
      <form action="login.php" method="post">
        <input type="text" name="email" class="form-control" placeholder="email" required> <br>
        <input type="password" name="password" class="form-control" placeholder="password" required> <br>
        <input type="submit" value="Login" class="form-control btn btn-primary">
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
