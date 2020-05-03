<?php
 // ---- NO LONGER USED ----
require "inc/function.inc.php"; // configuration file
connectDB(); // Connect to database

if ( !loggedIn() ){
  header("Location: login.php");
  die();
}
// if GET method used
if ( $_SERVER['REQUEST_METHOD'] == "GET"){
  // check that an id was given
  if ( !isset( $_GET['id'] ) ){
    // no id in the URL
    header("Location: users.php");
    die();
  } else {
    if ( $_GET['mode'] == "delete" ){
      // remove the user
      $id = $db->real_escape_string($_GET['id']);
      $sql = "DELETE FROM book_users WHERE id = '$id' LIMIT 1";
      $db->query($sql);

      header("Location: users.php?message=removed");

    } else {
      // fetch user from db
      $id = $db->real_escape_string( $_GET['id'] );
      $sql = "SELECT * FROM book_users WHERE id = '$id' LIMIT 1";
      $result = $db->query( $sql );
      if (!$result){
        // query did not work rediect
        header("Location: users.php");
        die();
      }
      if ( $result->num_rows != 1 ){
        header("Location: users.php?message=notFound");
        die();
      }
      $data = $result->fetch_assoc();
      
      

    }
  }
}else if ( $_SERVER['REQUEST_METHOD'] == "POST"){
  // validate our data
  if (isFieldEmpty($_POST['name']) || isFieldEmpty($_POST['email']) || 
  isFieldEmpty($_POST['pword'])){
    $errorMessage = "All fields are required";
  } else if ( !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL)){
    $errorMessage = "Email is not valid";
  }

  // check if we can save
  if ( $errorMessage == "" ){
    // we can save to the databse

    // encrypt password
    $pword = password_hash( $_POST['pword'], PASSWORD_DEFAULT );
    
    
    die("SAVE TO DB");
  }
  $data = $_POST;
}

$pageTitle = "Edit a User"; // Dynamic page title
include "inc/header.inc.php"; ?>
      <div class="row">
        <div class="col-12">
          <h2>Bookstore User</h2>
          <hr class="mb-4"> </div>
      </div>
     <?php displayErrors(); ?>
      <div class="row">
        <div class="col-md-12 p-3">
          <form action="" method="POST">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" value="<?=$data['name']; ?>">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" name="email" value="<?=$data['email']; ?>">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="pword" value="">
            </div>
            <input type="hidden" name="ID" value="<?php echo $data['id']; ?>" /><br />
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
<?php include "inc/footer.inc.php"; ?>