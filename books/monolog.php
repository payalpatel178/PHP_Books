<?php 
/* -------
	examples of the monolog logging library 
	This file may in the books folder but it's only using the composer autoload file
	
	If you wanted to use the logging library everywehre in your project, then you might consider adding a couple things to the functions.inc.php file
	------- */

//include composers autoloader
require_once "vendor/autoload.php" ;

// import the monolog library
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
// -- We need these to include the Logger object to start logging things
// -- and the StreamHandler because we are using files for out logs


// create a log channel
$log = new Logger("name_of_my_logger");
// -- Create the Logger object so that we can use all the properties and methods
// -- name_of_my_logger - is used to identify this specific logger should you have multiple ( REQUIRED )

// create a handler and tell the logger to use our handler 
$log->pushHandler( new StreamHandler( "logs/mono.log", Logger::DEBUG ) );
// -- pushHandler is used to tell monolog who and where to log our data
// -- StreamHandler is the object that will handle the writing to a file
// -- logs/monolog.log - is the relative location to your file ( CAN BE ANY FOLDER AND FILE )
// -- Logger::WARNING - this indicated the LOWEST level that you want to be logged

// start logging!
// -- exmaple of most to least "important"
$log->emergency("This is a emergency");
$log->alert("This is a alert");
$log->critical("This is a critical");
$log->error("This is a error");
$log->warning("This is a warning");
// if line -25 is still Logger::WARNING - you will not see the following in your log file
$log->notice("This is a notice"); 
$log->info("This is a info");
$log->debug("This is a debug");

// Need to add additional information to your entry?
$log->error("An error orccured", array("login_error", "payal"));

echo "GOOD JOB! - now go look at the newly created mono.log file in a new logs folder";
die();
?>