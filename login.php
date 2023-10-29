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
	 	 	 echo '<p class="error">You forgot to enter your email address!</p>';
	 	 }
	 	
	 	 // Validate the password:
	 	 if (!empty($_POST['pass'])) {
	 	 	 $p = mysqli_real_escape_string($dbc, $_POST['pass']);
	 } else {
	 	 	 $p = FALSE;
	 	 	 echo '<p class="error">You forgot to enter your password!</p>';
	 	 }
	 	 if(!empty($_POST['medicine_id'])){
	 	 	$medicine_id = mysqli_real_escape_string($dbc,$_POST['medicine_id']);
	 	 }else{
	 	 	$medicine_id =  FALSE;

	 	 }
	 	
	 	 if ($e && $p && $medicine_id) { // If everything's OK.
			echo($medicine_id);
	 	 	 // Query the database:
	 	 echo($e); echo($p);
	 	 	 $q = "SELECT user_id, first_name,user_level FROM users WHERE(email='$e' AND password=SHA1('$p')) AND active IS NULL";		
	 	 	 $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " .mysqli_error($dbc));
	 	 			
 	 	 if (@mysqli_num_rows($r) == 1) {
// A match was made.
			
	 	 	 	 // Register the values:
 	 	 	while ( $_SESSION = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

 	 	 		
	 	 	 	 	 	 	 	
	 	 	 	 // Redirect the user:
	 	 	 	 $url = 'cart.php?id='.$medicine_id.'&action=add';
// Define the URL.
	 	 	 	 ob_end_clean( ); // Delete the buffer.
	 	 	 	 header("Location: $url");

 	 	 	exit(); 
 	 	 	}
 	 	 		//echo($_SESSION['first_name']);
 	 	
	 	 		
	 	 	 	 
	 	 	 	
	 } else { // No match was made.
	 	 	 	 echo '<p class="error">Either the email address and password entered do not match those on file or you have not yet activated your account.</p>';
	 	 	 }
	 	 	
	 	 } else { // If everything wasn't OK.
	 	 	 echo '<p class="error">Please try again.</p>';
	 	 }
	 	mysqli_free_result($r);
	 	 mysqli_close($dbc);
	
	 } // End of SUBMIT conditional.
	 ?>
	
	 