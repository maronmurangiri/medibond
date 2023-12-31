<?php

// This file lists categories of products.


// Require the configuration before any PHP code:
require('./includes/config.inc.php');

// Validate the product type...
if (isset($_GET['type']) && ($_GET['type'] === 'goodies')) {
	$page_title = 'Our Goodies, by Category';
	$type = 'goodies';
} else { // Default is coffee!
	$page_title = 'Our Coffee Products';
	$type = 'coffee';	
}

// Include the header file:
include('./includes/header.html');

// Require the database connection:
require(MYSQL);

// Call the stored procedure:
$r = mysqli_query($dbc, "CALL select_categories('$type')");

// For debugging purposes:
//if (!$r) echo mysqli_error($dbc);

// If records were returned, include the view file:
if (mysqli_num_rows($r) > 0) {
	include ('./views/list_categories.html');
} else { // Include the error page:
	include ('./views/error.html');
}

// Include the footer file:
include ('./includes/footer.html');
?>