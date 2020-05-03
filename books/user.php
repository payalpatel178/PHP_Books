<?php
 
require "inc/function.inc.php"; // configuration file
connectDB(); // Connect to database

if ( !loggedIn() ){
  header("Location: login.php");
  die();
}

// set initial values
$data = array('name'=>"", 'email'=>"", 'id'=>""); // not password - security
$title = "Create a User"; // Dynamic page title

// if GET method used
if ( $_SERVER['REQUEST_METHOD'] == "GET"){
  // check that an id was given
  if (isset($_GET['id']) && is_numeric($_GET['id'])){
    $title = "Edit User"; // Dynamic page title
    // query db to check if user exists
    $data =  DB::queryFirstRow("SELECT * FROM book_users WHERE id=%i", $_GET['id']);
		if (DB::count() != 0){ // user exists

      if ( $_GET['mode'] == "delete" ){
        DB::delete('book_users', "id=%i", $_GET['id']);
        $user_removed= $data['name'];
        $current_logged_user= $_SESSION['name'];
        $log_user->warning("User has been removed", array("user_name: $user_removed","current_logged_in_user: $current_logged_user"));
        header("Location: users.php?message=removed&name=". htmlentities($data['name']));
        die();

      } else if ( $_GET['mode'] == "update" ){
        // setup page title
        $title = "Edit a user";
      }
    } else{
      header("Location: users.php?message=notFound");
      die();
    }
  }
}else if ( $_SERVER['REQUEST_METHOD'] == "POST"){
  // set info for form incase of error
  $id = isset($_POST['id']) ? $_POST['id'] : "";
	$name = isset($_POST['name']) ? $_POST['name'] : "";
  $email = isset($_POST['email']) ? $_POST['email'] : "";
  
  // validate our data
  if (isFieldEmpty($_POST['name']) || isFieldEmpty($_POST['email']) || 
  isFieldEmpty($_POST['pword'])){
    $errorMessage = "All fields are required";
  } else if ( !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL)){
    $errorMessage = "Email is not valid";
  }

  // check if we can save
  if ( $errorMessage == "" ){
    // no error = we can save to the databse

    // setup data to be inserted into the database
    $vars = array(
			'name' => $_POST['name'],  // name
			'email' => $_POST['email'], // email address
			'pword' => password_hash( $_POST['pword'], PASSWORD_DEFAULT ) // encrypt password
    );
    // we check for an id so we know if it's a create or an update
    if (isset($_POST['id']) && is_numeric($_POST['id']))
      $vars['id'] = $_POST['id'];

    /* INSERT ON DUPLICATE UPDATE statement - 
        meekro handles this for us should the id we give exist, it will update the record
          if it does not exist it will insert a new record
    */
    DB::insertUpdate("book_users", $vars);
    //updated so different redirection
		$action = isset($vars['id']) ? "updated" : "created";
    switch($action){
        case "created" :
          $log_user->notice("New user has been added", array("user_name: $name"));
          break;

        case "updated" :
          $log_user->info("User was updated", array("user_name: $name"));
          break;
    }
		header("Location: users.php?message=$action&name=". htmlentities($name));

  }
  $data = $_POST;
  
  // set the correct title for the page
  if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $title = "Edit User";
  }
}
include "inc/header.inc.php"; 
?>
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
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>" /><br />
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
<?php include "inc/footer.inc.php"; ?>