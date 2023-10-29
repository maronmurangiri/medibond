<?php
// This page is for editing a user record.
	 // This page is accessed through view_users.php.
	
	include ('includes/header.php');
	 $page_title = 'Edit Customer\'s information';
	// include ('includes/header.html');
	 echo '<h1>Edit Customer\'s information</h1>';
	
	 // Check for a valid user ID, through GET or POST:
	 if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	 	 $id = $_GET['id'];
	 } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	 	 $id = $_POST['id'];
	 } else { // No valid ID, kill the script.
	 	 echo '<p class="error">This page has been accessed in error.</p>';
	 	 echo('maron');
	 	 include ('includes/footer.html');
	 	 exit();
	 }
	
	 
	require('../includes/config.inc.php');
	 require (MYSQL);
	
	
	 // Check if the form has been submitted:
	 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	 	 $errors = array();
	 	  // Check for a first name:
	 	 if (empty($_POST['first_name'])) {
	 	 	 $errors[] = 'You forgot to enter your first name.';
	 	 } else {
	 	 	 $fn = mysqli_real_escape_string($dbc,trim($_POST['first_name']));
	 	 }
	 	
	 	 // Check for a last name:
	 	 if (empty($_POST['last_name'])) {
 	 	 $errors[] = 'You forgot to enter your last name.';
	 	 } else {
	 	 	 $ln = mysqli_real_escape_string($dbc,trim($_POST['last_name']));
	 	 }
	
	 	 // Check for an email address:
	 	 if (empty($_POST['email'])) {
	 	 	 $errors[] = 'You forgot to enter your email address.';
	 	 } else {
	 	 	 $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	 	 }
	 	 if (empty($_POST['address1'])) {
	 	 	 $errors[] = 'You forgot to enter your State address.';
	 	 } else {
	 	 	 $a = mysqli_real_escape_string($dbc, trim($_POST['address1']));
	 	 }

	 	 if (empty($_POST['city'])) {
	 	 	 $errors[] = 'You forgot to enter your City.';
	 	 } else {
	 	 	 $c = mysqli_real_escape_string($dbc, trim($_POST['city']));
	 	 }
	 	if (empty($_POST['state'])) {
	 	 	 $errors[] = 'You forgot to enter your state.';
	 	 } else {
	 	 	 $s = mysqli_real_escape_string($dbc, trim($_POST['email']));
	 	 }
	 	 if (empty($_POST['zip'])) {
	 	 	 $errors[] = 'You forgot to enter your ZIP code.';
	 	 } else {
	 	 	 $z = mysqli_real_escape_string($dbc, trim($_POST['zip']));
	 	 }
	 	 if (empty($_POST['phone'])) {
	 	 	 $errors[] = 'You forgot to enter your Phone number.';
	 	 } else {
	 	 	 $p = mysqli_real_escape_string($dbc, trim($_POST['phone']));
	 	 }
	 	 if (empty($_POST['date_created'])) {
	 	 	 $errors[] = 'You forgot to enter the purchase date.';
	 	 } else {
	 	 	 $d = mysqli_real_escape_string($dbc, trim($_POST['date_created']));
	 	 }
	 	 if (empty($errors)) { // If everything's OK.
	 	
	 	 	 //		Test for unique email address:
	 	 	 $q = "SELECT id FROM customers WHERE email='$e' AND user_id != $id";
	 	 	 $r = @mysqli_query($dbc, $q);
	 	 	 if (mysqli_num_rows($r) == 0) {
	
	 	 	 	 // Make the query:
	 	 	 	 $q = "UPDATE customers SET first_name='$fn', last_name='$ln',email='$e',address1='$a',city='$c',state='$s',zip='$z',phone='$p',date_created='$d' WHERE user_id=$id LIMIT 1";
	 	 	 	 $r = @mysqli_query ($dbc, $q);
	 	 	 	 if (mysqli_affected_rows($dbc)== 1) { // If it ran OK.
	
	 	 	 	 	 // Print a message:
	 	 	 	 	 echo '<p>The user has been edited.</p>';	
	 	
	 	 	 	 } else { // If it did not run OK.
	 	 	 	 	 echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>';
// Public message.
	 	 	 	 	 echo '<p>' . mysqli_error($dbc). '<br />Query: ' . $q . '</p>'; // Debugging message.
	 	 	 	 }
	 	 	 	 	
 	 	 } else { // Already registered.
	 	 	 	 echo '<p class="error">The email address has already been registered.</p>';
	 	 	 }
	 	 	
	 	 } else { // Report the errors.
	
	 	 	 echo '<p class="error">The following error(s) occurred:<br />';
	 	 	 foreach ($errors as $msg) {
// Print each error.
	 	 	 	 echo " - $msg<br />\n";
	 	 	 }
	 	 	 echo '</p><p>Please try again.</p>';
	 	
	 	 } // End of if (empty($errors)) IF.
	
	 } // End of submit conditional.
	
	 // Always show the form...
	
	 // Retrieve the user's information:
	 $q = "SELECT first_name, last_name,email,address1,address2,city,state,zip,phone,date_created FROM customers WHERE id=$id";
	 $r = @mysqli_query ($dbc, $q);
	
	 if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.
	
	 	 // Get the user's information:
	 	 $row = mysqli_fetch_array ($r,MYSQLI_NUM);
	 	
	 	 // Create the form:
	 	 echo '<form action="edit_user.php"method="post">
	 <p>First Name: <input type="text"name="first_name" size="15" maxlength="15"value="' . $row[0] . '" /></p>
	 <p>Last Name: <input type="text"name="last_name" size="15" maxlength="30"value="' . $row[1] . '" /></p>
	 <p>Email Address: <input type="text"name="email" size="20" maxlength="60"value="' . $row[2] . '"		/> </p>
	 <p>State Address: <input type="text"name="address1" size="20" maxlength="60"value="' . $row[3] . '"/> </p>
	 <p>City: <input type="text"name="city" size="15" maxlength="30"value="' . $row[4] . '" /></p>
	 <p>State: <input type="text"name="state" size="20" maxlength="60"value="' . $row[5] . '"/> </p>
	 <p>ZIP Code: <input type="text"name="zip" size="20" maxlength="60"value="' . $row[6] . '"/> </p>
	 <p>Phone Number: <input type="text"name="phone" size="20" maxlength="60"value="' . $row[7] . '"/> </p>
	 <p>Purchase Date: <input type="text"name="date" size="20" maxlength="60"value="' . $row[8] . '"/> </p>
	 <p><input type="submit" name="submit"value="Submit" /></p>
	 <input type="hidden" name="id" value="' .$id . '" />
	 </form>';
	
	 } else { // Not a valid user ID.
	 	 echo '<p class="error">This page has been accessed in error.</p>';
	 }
	
	 mysqli_close($dbc);
	 	 	
	 include ('includes/footer.html');
	 ?>