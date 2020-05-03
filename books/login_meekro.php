<?php
// include database connection file
require "inc/function.inc.php";

// check if already logged in
if (loggedIn()){
  header("Location: users.php");
  die();
}

// CHECK FOR POST METHOD
if ( $_SERVER['REQUEST_METHOD'] == "POST"){

  if ( isFieldEmpty( $_POST['email']) || isFieldEmpty( $_POST['pword']) ){
    // field is empty... ERRROR
    $errorMessage = "All fields are required";
  } else {
    // data is entered, check database

    $email = $db->real_escape_string( $_POST['email'] );

    $sql = "SELECT name, pword FROM book_users WHERE email = '$email' LIMIT 1";
    $results = $db->query( $sql );

    // was anythign returned from our query
    if ( $results->num_rows != 1 ){
      $errorMessage = "No user with that email was found";
    } else {
      // validate the password
      $row = $results->fetch_assoc();
      if ( !password_verify( $_POST['pword'], $row['pword']) ){
        $errorMessage = "Password does not match out records.";
      } else {
        //set our session variables
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['name'] = $row['name'];

        // redirect user
        header("Location: users.php");
        die();
      }
    }

  }

}

include "inc/header.inc.php";

?>
      <div class="row">
        <div class="col-12">
          <h2>Login</h2>
          <hr> </div>
      </div>

      <?php displayErrors(); ?>

      <div class="row">
        <div class="col-sm-12 col-md-6 offset-md-3">
          <form class="" action="login.php" method="POST">
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="pword">
            </div>
            <button type="submit" class="btn btn-primary" name="btnLogin">Log Me In</button>
          </form>
        </div>
      </div>
<?php include "inc/footer.inc.php"; ?>