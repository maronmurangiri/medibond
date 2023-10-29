<?php

// Are we live?
define('LIVE', false);
if (!defined('LIVE')) DEFINE('LIVE', true);

// Errors are emailed here:
DEFINE('CONTACT_EMAIL', 'murangirimaron@gmail.com');

// ************ SETTINGS ************ //
// ********************************** //

// ********************************** //
// ************ CONSTANTS *********** //
///Wamp64/www/    $location = 'https://' . BASE_URI . 'billing.php';
// Determine location of files and the URL of the site:
define('BASE_URI', '/Wamp64/www/medibond/');
define('BASE_URL', 'medicine/');
define('MYSQL', '../mysqli.inc.php');

// For the complex HTML:
define('BOX_BEGIN', '<!-- box begin --><div class="box alt"><div class="left-top-corner"><div class="right-top-corner"><div class="border-top"></div></div></div><div class="border-left"><div class="border-right"><div class="inner">');
define('BOX_END', '</div></div></div><div class="left-bot-corner"><div class="right-bot-corner"><div class="border-bot"></div></div></div></div><!-- box end -->');

// For Authorize.net:55nLqQ5L2', '2Lazr67xX97AL9Hj'
define('API_LOGIN_ID', '55nLqQ5L2');
define('TRANSACTION_KEY', '2Lazr67xX97AL9Hj');

// ************ CONSTANTS *********** //
// ********************************** //

// ****************************************** //
// ************ ERROR MANAGEMENT ************ //

// Function for handling errors.
// Takes five arguments: error number, error message (string), name of the file where the error occurred (string) 
// line number where the error occurred, and the variables that existed at the time (array).
// Returns true.
function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {

	// Build the error message:
	$message = "An error occurred in script '$e_file' on line $e_line:\n$e_message\n";
	
	// Add the backtrace:
	$message .= "<pre>" .print_r(debug_backtrace(), 1) . "</pre>\n";
	
	// Or just append $e_vars to the message:
	//	$message .= "<pre>" . print_r ($e_vars, 1) . "</pre>\n";

	if (!LIVE) { // Show the error in the browser.
		
		echo '<div class="error">' . nl2br($message) . '</div>';

	} else { // Development (print the error).

		// Send the error in an email:
		error_log ($message, 1, CONTACT_EMAIL, 'From:admin@example.com');
		
		// Only print an error message in the browser, if the error isn't a notice:
		if ($e_number != E_NOTICE) {
			echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div>';
		}

	} // End of $live IF-ELSE.
	
	return true; // So that PHP doesn't try to handle the error, too.

} // End of my_error_handler() definition.

// Use my error handler:
set_error_handler ('my_error_handler');

// ************ ERROR MANAGEMENT ************ //
// ****************************************** //

// Omit the closing PHP tag to avoid 'headers already sent' errors!