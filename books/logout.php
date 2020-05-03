<?php
require "inc/function.inc.php"; // configuration file

// start session to have access to SESSION superglobal
session_start();

// remove all existing session data
session_destroy();
session_unset();
$name=$_GET['name'];
$log_user->info("User has logged out", array("user_name: $name"));
// redirect
header("Location: login.php");

?>