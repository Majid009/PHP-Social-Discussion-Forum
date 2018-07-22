<?php
require 'config.php';
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
if(!$conn) die("Not Connected to Database");

$message = "";

if( isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) ){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $result = mysqli_query($conn , "select * from users where email='$email'");
    if(mysqli_num_rows($result)==1){
      $message = "<h3>email exists already ! </h3><br>";
    } else {
      $sql = "insert into users (username, email, password) values ('$username', '$email', '$password')";
      $result = mysqli_query($conn, $sql);
      if($result){
          $message = "<h3>Your Account has been created , you can <a href='login.php'>Login</a></h3><br>";
      }
    }
}
?>
<?php require 'header.php'; ?>
<div class="container main-container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h1 class="form_title">Sign Up</h1>
      <?php echo $message; ?>
      <form action="signup.php" method="post">
        <input type="text" name="username" class="form-control" placeholder="username" required> <br>
        <input type="text" name="email" class="form-control" placeholder="email" required> <br>
        <input type="password" name="password" class="form-control" placeholder="password" required> <br>
        <input type="submit" value="Sign Up" class="form-control btn btn-primary">
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
