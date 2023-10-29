<?php
include'head.php';
// This is the final page in the checkout process. 

// Require the configuration:
require('./includes/config.inc.php');

// Start the session:
//session_start();

// The session ID is the user's cart ID:
$uid = session_id();

// Check that this is valid:
if (!isset($_SESSION['customer_id'])) { // Redirect the user.
	$location ='checkout.php';
	header("Location: $location");
	exit();
}elseif (!isset($tresponse)) {
	
	//$location = 'billing.php';
	//header("Location: $location");
	//exit();
}
/*elseif (!isset($_SESSION['response_code']) || ($_SESSION['response_code'] != 1)) {
	echo "maron";
	$location = 'billing.php';
	header("Location: $location");
	exit();
}*/

// Require the database connection:
require(MYSQL);

// Clear out the shopping cart:
$r = mysqli_query($dbc, "CALL clear_cart('$uid')");

// Send the email:


include('./includes/email_receipt.php');

// Include the header file:
$page_title = 'Medicine - Checkout - Your Order is Complete';
include('./includes/checkout_header.html');

// Include the view:
include('./views/final.html');

// Clear the session:
$_SESSION = array(); // Destroy the variables.
session_destroy(); // Destroy the session itself.

// Include the footer file:
include('./includes/footer.html');
?>