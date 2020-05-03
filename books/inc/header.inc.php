<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- PAGE settings -->
  <title><?= isset($title)?"$title - ":""; ?>Super Awesome Bookstore</title>
  <meta name="author" content="Pingendo">
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
  <div class="py-5 text-center filter-dark">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="display-3 text-capitalize">My Super Aweome Bookstore</h1>
          <p class="lead text-white">Here is a Super Awesome Bookstore I created in PHP</p>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-md navbar-dark bg-secondary mb-3">
    <div class="container">
      <a class="navbar-brand" href="#">
        <b><?= loggedIn() ? "Hi " . $_SESSION['name'] : "Awesome Bookstore"; ?></b>
      </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSecondarySupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-center justify-content-end" id="navbarSecondarySupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="books.php"> Books</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="users.php"> Users</a>
          </li>
          <li class="nav-item">
            <?php if ( loggedIn() ) {
              $name=$_SESSION['name'];?>
              <a class="nav-link" href="logout.php?name=<?=$name?>"> Logout</a>
            <?php } else { ?>
              <a class="nav-link" href="login.php"> Login</a>
            <?php } ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="pb-5">
    <div class="container">