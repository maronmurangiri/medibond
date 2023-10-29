<?php

// This file contains the database access information. 
// This file establishes a connection to MySQL and selects the database.
// This file defines a function for making data safe to use in queries.

// Set the database access information as constants:
DEFINE ('DB_USER', 'id18333208_maron');
DEFINE ('DB_PASSWORD', '2KG*)sWb-ebH?5^5');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'id18333208_medibond');


// Make the connection:
$dbc = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
/*if($dbc){
	echo('seccess');
}else{echo "fail";}
// Set the character set:
mysqli_set_charset($dbc, 'utf8');*/

// Function for escaping and trimming form data.
// Takes one argument: the data to be treated (string).
// Returns the treated data (string).*/
?>