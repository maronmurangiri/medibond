<?php
session_start();
require ('includes/config.inc.php');
require (MYSQL);
if ($_SERVER['REQUEST_METHOD'] == 'POST' )
	{ 
	 	// Check for a first name:
	 	 if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $_POST['first_name'])) {
	 	 	 $fn = mysqli_real_escape_string($dbc, $_POST['first_name']);
	 	 } else {
	 	 	 echo '<p class="error">Please enter your first name!</p>';
	 	 }
	
	 	 // Check for a last name:
	 	 if (preg_match ('/^[A-Z \'.-]{2,40}$/i',$_POST['last_name'])) {
	 	 	 $ln = mysqli_real_escape_string($dbc, $_POST['last_name']);
	 	 } else {
	 	 	 echo '<p class="error">Please enter your last name!</p>';
	 	 }
	 	 if (isset($_POST['dob'])) {
	 	 	 $dob = mysqli_real_escape_string($dbc, $_POST['dob']);
	 	 } else {
	 	 	 echo '<p class="error">Please enter your phone number!</p>';
	 	 }
	 	 if (isset($_POST['gender'])) {
	 	 	 $g = mysqli_real_escape_string($dbc, $_POST['gender']);
	 	 } else {
	 	 	 echo '<p class="error">Please pick your gender!</p>';
	 	 }


	 	  if (isset($_POST['phone'])) {
	 	 	 $pn = mysqli_real_escape_string($dbc, $_POST['phone']);
	 	 } else {
	 	 	 echo '<p class="error">Please enter your phone number!</p>';
	 	 }
	 	// Check for an email address:
	 	 if (isset($_POST['allergy'])) {
	 	 	 $a = mysqli_real_escape_string($dbc, $_POST['allergy']);
	 	 } else {
	 	 	 echo '<p class="error">Please enter allergy if any!</p>';


	 	 	 }
	
	 	 // Check for a password and match against the confirmed password:
	 	 if (isset($_POST['conditions'])) {
	 	 	 $c = mysqli_real_escape_string($dbc, $_POST['conditions']);
	 	 } else {
	 	 	 echo '<p class="error">Please enter any underlying condition  if any!</p>';


	 	 	 }
	 	  if (isset($_POST['medications'])) {
	 	 	 $m = mysqli_real_escape_string($dbc, $_POST['medications']);
	 	 } else {
	 	 	 echo '<p class="error">Please enter any underlying medications if any!</p>';


	 	 	 }

	 	echo($_SESSION['user_id']);
	 	 if ($fn && $ln && $dob && $pn && $a && $c && $g && $m) { 
	 	 	If(isset($_GET['patient_id'])){
	 	 		echo ($_GET['patient_id']);
	 	 	}
	 	 	$q = "UPDATE patients SET first_name = '".$fn."', last_name='".$ln."', DOB = '".$dob."', phone = ".$pn.", Allegies = '".$a."', conditions = '".$c."', medications = '".$m."' WHERE patient_id = ".$_SESSION['patient_id'].";";
	 	 	$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " .mysqli_error($dbc));
	 	 	if(mysqli_affected_rows($dbc) == 1){
	 	 		$url = 'patient.php?success=1';
	 	 		header("Location:$url");
	 	 		exit();
	 	 	}else{
	 	 		echo "not ret";
	 	 	}
	 	 }else{
	 	 	echo "maron";
	 	 }
	 }
	 	 ?>