 <?php 
	 // This is the registration page for the site.
	 require ('includes/config.inc.php');
	 $page_title = 'Register';
 include ('header.php');
	
	 if ($_SERVER['REQUEST_METHOD'] == 'POST')
{ // Handle the form.
	
	 	 // Need the database connection:
	 	 require (MYSQL);
	 	
	 	 // Trim all the incoming data:
	 	 //$trimmed = array_map('trim', $_POST);
	
	 	 // Assume invalid values:
	 	 $fn = $ln = $e = $p = FALSE;
	 	
	 	 // Check for a first name:
	 	 if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $_POST['first_name'])) {
	 	 	 $fn = mysqli_real_escape_string($dbc, $_POST['first_name']);
	 	 } else {
	 	 	 $url = 'index.php?e="Please enter your first name!"';
	 	 	 	 header("Location: $url");
	 	 	 	 exit();
	 	 }
	
	 	 // Check for a last name:
	 	 if (preg_match ('/^[A-Z \'.-]{2,40}$/i',$_POST['last_name'])) {
	 	 	 $ln = mysqli_real_escape_string($dbc, $_POST['last_name']);
	 	 } else {
	 	 	 $url = 'index.php?e="Please enter your last name!"';
	 	 	 	 header("Location: $url");
	 	 	 	 exit();
	 	 }

	 	  if (isset($_POST['phone'])) {
	 	 	 $pn = mysqli_real_escape_string($dbc, $_POST['phone']);
	 	 } else {
	 	 	 $url = 'index.php?e="Please enter your Phone number!"';
	 	 	 	 header("Location: $url");
	 	 	 	 exit();
	 	 }
	 	 if (isset($_POST['auth'])) {
	 	 	 $au = mysqli_real_escape_string($dbc, $_POST['auth']);
	 	 } 
	 	
	 	 // Check for an email address:
	 	 if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	 	 	 $e = mysqli_real_escape_string($dbc, $_POST['email']);
	 	 } else {
	 	 	 $url = 'index.php?e="Please enter a valid email address!"';
	 	 	 	 header("Location: $url");
	 	 	 	 exit();

	 	 	 }
	
	 	 // Check for a password and match against the confirmed password:
	 	 if (preg_match ('/^\w{4,20}$/', $_POST['password1']) ) {
	 	 	 if ($_POST['password1'] == $_POST['password2']) {
	 	 	 	 $p = mysqli_real_escape_string ($dbc, $_POST['password1']);
	 	 	 } else {
	 	 	 	
	 	 	 	 $url = 'index.php?e="Your password did not match the confirmed password!"';
	 	 	 	 header("Location: $url");
	 	 	 	 exit();
	 	 	 }
	 	 } else {
	 	 	  $url = 'index.php?e="Please enter a valid password!"';
	 	 	 	 header("Location: $url");
	 	 	 	 exit();
	 	 }
	 	
	 	 if ($fn && $ln && $pn && $e && $au && $p) { // If everything's OK...
	
	 	 	 // Make sure the email address is available:
	 	 	 $q = "SELECT user_id FROM users WHERE email='$e'";
	 	 	 $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " .mysqli_error($dbc));
	 	 	
	 	 	 if (mysqli_num_rows($r) == 0) { // Available.
	
	 	 	 	 // Create the activation code:
	 	 	 	 $a = md5(uniqid(rand( ), true));
	
	 	 	 	 // Add the user to the database:
	 	 	 	 $q = "INSERT INTO users (email, password, first_name, last_name,phone, active, registration_date,auth) VALUES ('$e', SHA1('$p'), '$fn', '$ln','$pn', NULL, NOW( ),'$au')";
	 	 	 	 $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " .mysqli_error($dbc));
	
	 	 	 	 if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

	 	 	 	 	$location =  'index.php?success=1';
					header("Location: $location");
					exit();

				
    
	 	 	 	 	 // Send the email:
	 	 	 	 	/* $body = "Thank you for registering at <whatever site>. To activate your account, please click on this link:\n\n";
	 	 	 	 	 $body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";
	 	 	 	 	  mail($trimmed['email'], 'Registration Confirmation', $body, 'From: admin@medibond.com'))
	 	 	 	 		
	 	 	 	 	 // Finish the page:
	 	 	 	 	 echo '<h3>Thank you for registering! A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account.</h3>';*/
	 	 	 	 	 include ('footer.php'); // Include the HTML footer.
	 	 	 	 	 exit(); // Stop the page.}
	 	 	 	 	
	 	 	 	 } else { // If it did not run OK.

	 	 	     $url = 'index.php?e="You could not be registered due to a system error. We apologize for any inconvenience."';
	 	 	 	 header("Location: $url");
	 	 	 	 exit();
	 	 	 	 }
	 	 	 	
	 	 	 } else { // The email address is not available.
	 	 	 	
	 	 	 	  $url = 'index.php?e="That email address has already been registered. If you have forgotten your password, use the link at right to have your password sent to you.	"';
	 	 	 	 header("Location: $url");
	 	 	 	 exit();
	 	 	 }
	 	 	
	 	 } else { // If one of the data tests failed.
	 	 	 $url = 'index.php?e="Please try again."';
	 	 	 	 header("Location: $url");
	 	 	 	 exit();
	 	 }
	
	 	 mysqli_close($dbc);
	
	 } // End of the main Submit conditional.
	 ?>
	 	
	 <h1>Register</h1>
	 
	 </form>
	
 <?php include ('includes/footer.html'); ?>