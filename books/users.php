<?php 

require "inc/function.inc.php"; // configuration file
connectDB(); // Connect to database

/*
// Check new users
if ( $_SERVER['REQUEST_METHOD'] == "POST"){ // post method?
  // validate our data
  if (isFieldEmpty($_POST['name']) || isFieldEmpty($_POST['email']) || 
      isFieldEmpty($_POST['pword']) || isFieldEmpty($_POST['confirm'])){
    $errorMessage = "All fields are required";
  } else if ( !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL)){
    $errorMessage = "Email is not valid";
  } else if ($_POST['pword'] !== $_POST['confirm']){
    $errorMessage = "Passwords do not match";
  }


   // check if we can save
  if ( $errorMessage == "" ){
    // we can save to the databse

    // encrypt password
    $pword = password_hash( $_POST['pword'], PASSWORD_DEFAULT );
    
    $sql = "INSERT INTO book_users (name, email, pword) 
      VALUES ('". $db->real_escape_string( $_POST['name'] ) ."', 
              '". $db->real_escape_string( $_POST['email'] ) ."', 
              '". $db->real_escape_string( $pword ) ."' )";
    $results = $db->query( $sql );
    if ( !$results ){
      die("Error during insert: " . $db->error );
    }
    header("Location: users.php?message=created");
  }

} else*/ if (isset ($_GET['message'] )){
  $name  = isset($_GET['name']) ? $_GET['name'] : "";

  switch ($_GET['message']){
    case "removed" :
      $errorMessage = "User $name has been removed";
      break;

    case "updated" :
      $errorMessage = "User $name has been saved";
      break;

    case "created" :
      $errorMessage = "User $name has been created";
      break;

    case "notFound":
      $errorMessage = "No user found";
      break;
  }
}

// fetch users from database
$sql = "SELECT * FROM book_users ORDER BY name ASC";
$results = $db->query( $sql );
if ( !$results )
  die("Error during select: " . $db->error );

$title = "Users"; // Dunamic page title
include "inc/header.inc.php"; // header 
?>
<?php /* 
      <div class="row">
        <div class="col-12">
          <h2>Create User</h2>
          <hr> </div>
      </div>

   

      <div class="row">
        <div class="col-sm-12 col-md-6 offset-md-3">
          <form class="" action="users.php" method="POST">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="pword">
              <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Confirm Password</label>
              <input type="password" class="form-control" name="confirm">
              <small class="form-text text-muted"></small>
            </div>
            <button type="submit" class="btn btn-primary">Save My Info</button>
          </form>
        </div>
      </div> */ ?>
      <div class="row mt-4">
        <div class="col-12">
          <h2>List All User - <a class="btn btn-sm btn-success pull-right" href="user.php">Create</a></h2>
          <hr>
          <?php displayErrors(); ?>
        </div>
        
        <div class="table-responsive col-12">
          <table class="table table-hover table-striped table-bordered">
            <thead class="thead-dark">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
             <?php while ($row = $results->fetch_assoc()){ ?>
                <tr>
                  <td><?=$row['id'];?></td>
                  <td><?=$row['name'];?></td>
                  <td><?=$row['email']; ?></td>  
                  <td><?=$row['pword']; ?></td>
                  <td>
                  <!-- <a href="user_edit.php?id=<?=$row['id'];?>&mode=edit">Edit</a> | 
                    <a href="user_edit.php?id=<?=$row['id'];?>&mode=delete">Delete</a> -->
                    <a href="user.php?id=<?=$row['id'];?>&mode=edit">Edit</a> | 
                    <a href="user.php?id=<?=$row['id'];?>&mode=delete">Delete</a>
                  </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

<?php include "inc/footer.inc.php"; //footer ?>