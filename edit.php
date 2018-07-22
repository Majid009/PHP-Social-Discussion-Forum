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
// Retrieving Categories
  $sql = "select * from Categories";
  $result_categories = mysqli_query($conn, $sql);

if(isset($_GET['q_id'])){
  $id = $_GET['q_id'];
  $sql = "select * from questions where id='$id'";
  $result = mysqli_query($conn , $sql);
  $row = mysqli_fetch_array($result);
  $title = $row['title'];
  $body  = $row['body'];
}

$message ="";

// update question
if(isset( $_POST['title']) && isset($_POST['body']) && isset($_POST['category']) ){
  $id = $_GET['q_id'];
  $title = $_POST['title'];
  $body = $_POST['body'];
  $category = $_POST['category'];
  $user_id = $_SESSION['user_id'];
  $sql = "update questions set title='$title' , body='$body' , category_id='category' where id='$id'";
  if( mysqli_query($conn, $sql) ){
    $message = "Your question has been updated";
  }
}
?>
<?php require 'header.php'; ?>
<div class="container main-container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h2>Update you question</h2>
      <form class="" action="edit.php?q_id=<?php echo $_GET['q_id']; ?>" method="post">
        <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Title of your question" class="form-control" required> <br>
        <textarea name="body" rows="7" class="form-control" placeholder="describe your question in deatils" required><?php echo $body; ?></textarea>
           <br> <select name="category" placeholder="category" class="form-control">
              <option value="">select category</option>
              <?php
              while ($row = mysqli_fetch_array($result_categories)) {
                $id = $row['id'];
                echo "<option value='$id'>".$row['name']."</option>";
              }
               ?>
           </select>
        <br><input type="submit" value="Post" class="btn btn-primary">
      </form>
        <?php echo "<h2>".$message."</h2>"; ?>
    </div>
  </div>
</div>
