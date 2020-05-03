<?php
  require "inc/function.inc.php"; // configuration file
  connectDB(); // Connect to database

  if (isset ($_GET['message'] )){
    $bookTitle  = isset($_GET['title']) ? $_GET['title'] : "";

    switch ($_GET['message']){
      case "removed" :
        $errorMessage = "Book $bookTitle has been removed";
        break;
      case "updated" :
        $errorMessage = "Book $bookTitle has been saved";
        break;
      case "created" :
        $errorMessage = "Book $bookTitle has been created";
        break;
      case "notFound":
        $errorMessage = "No book found";
        break;
  }
}
  // fetch books from database 
  $results = DB::query("SELECT id, title, author, pub_year, description FROM book_books WHERE archived = 0");
  $title = "Books"; // Dunamic page title

  //HEADER
  include "inc/header.inc.php"; 
?>
       <div class="row mt-4">
        <div class="col-12"> 
          <h2>List All Books - <a class="btn btn-sm btn-success pull-right" href="book.php">Add Book</a></h2>
          <hr>
          <?php displayErrors(); ?>
        </div>
        <div class="table-responsive col-12">
          <table class="table table-hover table-striped table-bordered">
            <thead class="thead-dark">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Author</th>
                <th>Year</th>
                <th>Description</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($results as $row){ ?>
                <tr>
                  <td width="5%"><?=$row['id'];?></td>
                  <td width="15%"><?=$row['title'];?></td>
                  <?php
                    //fetch author name from database dependes on id(reference key)
                    $authorsResult = DB::queryFirstRow("SELECT id, author FROM book_authors WHERE id=%i", $row['author']);
                  ?>
                  <td width="14%"><?=utf8_encode($authorsResult['author']); ?></td>  
                  <td width="5%"><?=$row['pub_year']; ?></td>
                  <td width="50%" class="text-justify"><?=$row['description']; ?></td>
                  <td width="11%">
                    <a href="book.php?id=<?=$row['id'];?>&mode=edit">Edit</a> | 
                    <a href="book.php?id=<?=$row['id'];?>&mode=delete">Delete</a>
                  </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php include "inc/footer.inc.php"; ?>