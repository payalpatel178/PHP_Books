<?php //function.inc.php

// This is going to be my main configuration file

//start session
session_start();

// import the monolog library
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

//include composers autoloader
require_once "vendor/autoload.php" ;

// create a log channel
$log_user = new Logger("users_logger");
$log_book = new Logger("books_logger");

// create a handler and tell the logger to use our handler 
$log_user->pushHandler( new StreamHandler( "logs/users.log", Logger::INFO ) );
$log_book->pushHandler( new StreamHandler( "logs/books.log", Logger::INFO ) );

//MEEKRO - database variables
DB::$user = 'ipd19';
DB::$password = 'ipdipd';
DB::$dbName = 'ipd19';


$errorMessage = ""; // variable to monitor errors
$errorMessage = ""; // variable to monitor success
$db = null;	// variable for built-in database connection 

/**
 * Connect to mysqli database
 */
function connectDB(){
	global $db;

	// connect to database
	$db = new mysqli("localhost", "ipd19", "ipdipd","ipd19");

	// check connection successful
	if( $db->connect_errno > 0){
		die("Connection failed: " . $db->connect_error);
	}
}

/**
 * Pretty printout of given variable
 *
 * @param [*] $data
 */
function pr($data){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

/**
 * Validate if a given variable is empty
 *
 * @param [string] $field
 * @return boolean
 */
function isFieldEmpty( $field ){
	return ( !isset( $field ) || trim( $field ) == "" );
}

/**
 * Output error messages
 *
 * @return void
 */
function displayErrors(){
	
	global $errorMessage; // use the variable that was created OUTSIDE the function.

	if ($errorMessage != "") { ?>
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<div class="alert alert-info">
					<h4 class="alert-heading">Important Information!</h4>
					<p class="mb-0"><?=$errorMessage; ?></p>
				</div>
			</div>
		</div>
	<?php }
}

/**
 * Verify if user is logged in using session variables.
 *
 * @return Boolean
 */
function loggedIn(){
	if ( isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true ){
		if ( !isset( $_SESSION['name'] ) ){
			$_SESSION['name'] = "Random Person";
		}
		return true;
	}else{
		return false;
	}
}


?>