<?php
session_start();
require 'config.php';
$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
if(!$conn){
  die("Not connected to Database");
}

// Post new question
if(isset( $_POST['title']) && isset($_POST['body']) && isset($_POST['category']) ){
  $title = $_POST['title'];
  $body = $_POST['body'];
  $category = $_POST['category'];
  $user_id = $_SESSION['user_id'];
  $sql = "insert into questions (user_id, category_id, title, body) values ('$user_id', '$category', '$title', '$body')";
  mysqli_query($conn, $sql);
}

// Retrieving Categories
  $sql = "select * from Categories";
  $result_categories = mysqli_query($conn, $sql);

// Retrieving questions
    $sql = "select * from questions order by created_at DESC";
    $result_questions = mysqli_query($conn, $sql);

    if(isset($_GET['c_id']) && isset($_GET['c_name'])){
      $id = $_GET['c_id'];
      $sql = "select * from questions where category_id='$id' order by created_at DESC";
      $result_questions = mysqli_query($conn, $sql);
    }
?>
<?php require 'header.php'; ?>
<div class="container main-container">
  <div class="row">
    <div class="col-md-3">
     <ul class="nav nav-pills nav-stacked">
        <li><h3>Categories</h3></li>
        <?php
        while ($row = mysqli_fetch_array($result_categories)) {
          $id = $row['id'];
          $name = $row['name'];
          echo "<li><a href='questions.php?c_id=$id&c_name=$name'>".$row['name']."</a></li>";
        }
        // set the pointer back to the beginning
        mysqli_data_seek($result_categories, 0);
         ?>
     </ul>
    </div>
    <div class="col-md-9 main_content">
      <h2><?php echo "Category: ".$_GET['c_name']; ?></h2>
        <?php while ($row = mysqli_fetch_array($result_questions)) {
            $id = $row['id'];
            $user_id = $row['user_id'];
            $category_id = $orw['category_id'];
            $title = $row[title];
            $body = $row['body'];
            $meta = $row['created_at'];
       ?>
       <h2 class="question_title"> <a href="question.php?q_id=<?php echo $id; ?>"> <?php echo $title; ?> </a> </h2>
       <p class="question_meta"><strong>Posted On: </strong><?php echo $meta; ?></p>
       <p class="question_body"><?php echo $body; ?></p>
       <?php if($_SESSION['user_id'] == $user_id ) { ?>
         <a href="edit.php?q_id=<?php echo $id; ?>" class="btn btn-default"> Edit </a>
         <a href="delete.php?q_id=<?php echo $id; ?>" class="btn btn-danger"> Delete </a>
      <?php }?> <hr>

       <?php } ?>

    </div>
  </div>
</div>
<?php  require 'footer.php'; ?>
