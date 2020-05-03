<?php
  require "inc/function.inc.php"; // configuration file
  connectDB(); // Connect to database

  if ( !loggedIn() ){
    header("Location: login.php");
  die();
}
  // set initial values
  $data = array('title'=>"", 'author'=>"", 'pub_year'=>"", 'description'=>"", 'id'=>"");
  $title = "Add a Book"; // Dynamic page title
  
  // if GET method used
  if ( $_SERVER['REQUEST_METHOD'] == "GET"){
    
    // check that an id was given
    if (isset($_GET['id']) && is_numeric($_GET['id'])){
      $title = "Edit Book"; // Dynamic page title
    // query db to check if book exists
    $data =  DB::queryFirstRow("SELECT * FROM book_books WHERE id=%i", $_GET['id']);
		if (DB::count() != 0){ // book exists

      if ( $_GET['mode'] == "delete" ){
        DB::delete('book_books', "id=%i", $_GET['id']);
        $book_removed= $data['title'];
        $current_logged_user= $_SESSION['name'];
        $log_book->warning("Book has been removed", array("book_title: $book_removed","current_logged_in_user: $current_logged_user"));
        header("Location: books.php?message=removed&title=". htmlentities($data['title']));
        die();

      } else if ( $_GET['mode'] == "update" ){
        // setup page title
        $title = "Edit book";
      }
    } else{
      header("Location: books.php?message=notFound");
      die();
    }
  }

  }
  else if ( $_SERVER['REQUEST_METHOD'] == "POST"){
   
    // set info for form incase of error
    $id = isset($_POST['id']) ? $_POST['id'] : "";
	  $title = isset($_POST['title']) ? $_POST['title'] : "";
    $author = isset($_POST['author']) ? $_POST['author'] : "";
    $pub_year = isset($_POST['pub_year']) ? $_POST['pub_year'] : "";
    $description = isset($_POST['description']) ? $_POST['description'] : "";
  
    // validate our data
    if (isFieldEmpty($_POST['title']) || isFieldEmpty($_POST['author']) || 
      isFieldEmpty($_POST['pub_year']) || isFieldEmpty($_POST['description'])){
      $errorMessage = "All fields are required";
    } 
    else if($_POST['author']==0){
      $errorMessage= "Author is not selected";
    }
    else if($_POST['pub_year']==0){
      $errorMessage= "Year of Publication is not selected";
    }
    
    // check if we can save
    if ( $errorMessage == "" ){
    // no error = we can save to the database

    // setup data to be inserted into the database
    $vars = array(
			'title' => $_POST['title'],  // book title
			'author' => $_POST['author'], // author
      'pub_year' => $_POST['pub_year'], // publication year
      'description' => $_POST['description'] // description
    );
    // we check for an id so we know if it's a create or an update
      if (isset($_POST['id']) && is_numeric($_POST['id']))
        $vars['id'] = $_POST['id'];

      DB::insertUpdate("book_books", $vars);
      //updated so different redirection
      $action = isset($vars['id']) ? "updated" : "created";
      
      switch($action){
        case "created" :
            $log_book->notice("New book has been added", array("book_title: $title"));
            break;

        case "updated" :
            $log_book->info("Book has been updated", array("book_title: $title"));
            break;
      }
		header("Location: books.php?message=$action&title=". htmlentities($title));

  }
  $data = $_POST;
  
  // set the correct title for the page
  if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $title = "Edit Book";
  }
}

  // fetch authors from database
  $results = DB::query("SELECT id as author_id,author FROM book_authors");

  //HEADER
  include "inc/header.inc.php"; 
?>
      <div class="row">
        <div class="col-12">
          <h2>Bookstore Books</h2>
          <hr class="mb-4"> </div>
      </div>
     <?php displayErrors(); ?>
        <div class="row">
          <div class="col-sm-12 col-md-8 offset-md-2">
            <form action="" method="POST">
              <div class="form-group">
                <label>Book Title</label>
                <input type="text" class="form-control" name="title" value="<?=$data['title']; ?>">
              </div>
              <div class="form-group">
                <label>Author</label>
                <select class="form-control" name="author" value="<?=$data['author']; ?>">
                  <option value=0> ----------  Please Select Author ---------- </option>
                  <?php foreach ($results as $row){ ?>
                    <option value="<?=$row['author_id'];?>" <?php if($data['author']==$row['author_id']){echo "selected";}?>><?=$row['author']; ?></option>
                <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Year of Publication</label>
                <select class="form-control" name="pub_year" value="<?=$data['pub_year']; ?>">
                  <option value=0> ----------  Please Select Year ---------- </option>
                <?php 
                  //setting current year
                  $currentYear=date('Y');

                  //setting year until where to show the options
                  $startYear=1950;

                  foreach (range($currentYear, $startYear) as $year){ ?>
                    <option value="<?=$year;?>" <?php if($data['pub_year']==$year){echo "selected";}?>><?=$year; ?></option>
                <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="3" name="description"><?=$data['description']; ?></textarea>
              </div>
              <input type="hidden" name="id" value="<?php echo $data['id']; ?>" /><br />
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
      </div>
<?php include "inc/footer.inc.php"; ?>