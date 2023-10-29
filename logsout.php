 <?php
	 // This is the logout page for the site.
 require ('includes/config.inc.php');
 $page_title = 'Logout';
	 include ('head.php');
	
	 // If no first_name session variable exists, redirect the user:
	 	 if (!isset($_SESSION['user_id'])) {
	
	 	 $url = 'home.php'; //


	 	 ob_end_clean( ); // Delete the buffer.
	 	 header("Location: $url");
	 	 exit( ); 
	 	
	 } else { // Log out the user.
	
	 	 $_SESSION = array(); // Destroy the variables.
	 	 session_destroy(); // Destroy the session itself.
	 	 setcookie (session_name(), '',time()-3600); // Destroy the cookie.
	
	 }
	
	 // Print a customized message:
	 $url = 'home.php';
	 header("Location: $url");
	 echo '<h3>You are now logged out.</h3>';
	
	 include ('includes/foot.php');
	 ?>