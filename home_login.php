<?php 
	 require ('includes/config.inc.php');
	 $page_title = 'Login';
	 include ('Lhead.php');
	
	 if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	 	 require (MYSQL);
 	
	 	 // Validate the email address:
	 	 if (!empty($_POST['email'])) {
	 	 	 $e = mysqli_real_escape_string($dbc, $_POST['email']);
	 	 } else {
	 	 	
	 	 	 $e = FALSE;
	 	 	 $url = 'home.php?e="You forgot to enter your email address!"';
	 	 	 	 header("Location: $url");
	 	 	 	 exit();
	 	 }
	 	
	 	 // Validate the password:
	 	 if (!empty($_POST['psw'])) {
	 	 	 $p = mysqli_real_escape_string($dbc, $_POST['psw']);
	 } else {
	 		 $p = FALSE;
	 	 	 $url = 'home.php?e="You forgot to enter your password!"';
	 	 	 header("Location: $url");
	 	 	 exit();
	 	 }
	 	 
	 	
	 	 if ($e && $p) { // If everything's OK.
			
	 	 	 // Query the database:
	 	 	 $q = "SELECT user_id, first_name,user_level FROM users WHERE(email='$e' AND password=SHA1('$p')) AND active IS NULL";		
	 	 	 $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " .mysqli_error($dbc));
	 	 			
 	 	 if (@mysqli_num_rows($r) == 1) {
// A match was made.
			
	 	 	 	 // Register the values:
 	 	 	while ( $_SESSION = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

 	 	 		mysqli_free_result($r);
	 	 	 	 mysqli_close($dbc);
	 	 	 	 	 	 	 	
	 	 	 	 // Redirect the user:
	 	 	 	 $url = 'index2.php';
// Define the URL.
	 	 	 	 ob_end_clean( ); // Delete the buffer.
	 	 	 	 header("Location: $url");

 	 	 	exit(); 
 	 	 	}
 	 	 		//echo($_SESSION['first_name']);
 	 	
	 	 		
	 	 	 	 // Quit the script.
	 } else { 
	 // No match was made.
 	 	 			
	 	 	 	 $url = 'home.php?e="Either the email address and password entered do not match those on file or you have not yet activated your account."';
	 	 	 	 header("Location: $url");
	 	 	 	 exit(); 
	 	 	 }
	 	 	
	 	 } else { // If everything wasn't OK.
	 	 		
	 	 	 $url = 'home.php?e="Please try again."';
	 	 	 	 header("Location: $url");
	 	 	 exit();
	 	 }
	 	
	 	 mysqli_close($dbc);
	
	 } // End of SUBMIT conditional.
	 ?>
	
	 