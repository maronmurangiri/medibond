<?php
include 'head.php';
//session_start();
?><!DOCTYPE html>
<html>
<head>
	<title></title>
	<script>
        function myFunction() {
                alert("Patient Details Updated!");
            }
    </script>
	<style type="text/css">
		.patient{
			background-color: green;
			color: white;
			padding: 5px;
			font-size: 25px;
			margin-top: 300px;
			margin-left: 1100px;
			border:none;
			//border-radius:50%;
		}
		.plus{
			padding: 5px;
		}
		.patients{
			margin-top: -40px;
		}
		.use{
			font-size: 40px;
			margin-left: 20px;
		}
		.patients1{
			margin-left: 80px;
			font-size: 30px;
			margin-top: -40px;
			font-weight: bold;
		}
		.patients2{
			margin-top: 5px;
			margin-left: 80px;
		}


		.table{
			margin-top: 80px;
			margin-left: 20px;
		}
		.pres{
			margin-top: 320px;
			margin-left: 150px;
		}
		.table{
			margin-top: 40px;
			margin-right: 5px;
			margin-left: 5px;
			
		}
		
		table, th, td{
 			 border: 1px solid black;
			 border-collapse: collapse;
			 margin-left: 30px;
			 margin-top: 30px;
		}
		th, td {
  			padding: 20px;
		}
		table {
  			border-spacing: 1px;

		
		}
	</style>
</head>
<body>
	<?php
	if ( isset($_GET['success']) && $_GET['success'] == 1 )
{
     echo "<body onload=\"myFunction()\">";
}

		
		require './includes/config.inc.php';
	 	 
	 	 require (MYSQL);

		include 'patient_popup.php';
		include'edit_patient_popup.php';
		/*<i class="far fa-save"></i>
	<i class="fas fa-sign-in-alt"></i><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-right"></i>*/
	?>
	<button class="patient" onclick="openpForm()">Add New Patient<b class="plus"><i  class="fas fa-plus"></i></b></button>
	<div class="patients">
		<div class="use"><i class="fas fa-users"></i></div>
		<div class="patients1">Patients</div>	
		<div class="patients2">Click 'Add New Patient' to add a new patient. Click 'Edit' or 'Delete' on a patient to edit their details or delete them.</div>
	</div>
	<?php

$t = "SELECT * FROM patients WHERE user_id = ".$_SESSION['user_id'].";";
				$k = mysqli_query($dbc, $t) or trigger_error("Query: $t \n<br />MySQL Error: " .mysqli_error($dbc));
				if(mysqli_num_rows($k)>0){
					echo "<table>
			<tr>
				<th>delete</th>
				<th>Edit</th>
				<th>Name</th>
				<th>Date of birth</th>
				<th>Age</th>
				<th>Gender</th>
				<th>Phone Number</th>
				<th>Medications</th>
				<th>Allergies</th>
				<th>Conditions</th>
			</tr>
			";
					while($row = mysqli_fetch_array($k,MYSQLI_ASSOC)){
							
			$today = date("Y-m-d");
			$diff = date_diff(date_create($row['DOB']), date_create($today));
					 

				echo "<tr>
				<td><a href='delete_patient.php?id=".$row['patient_id']."'>Delete</a></td>
				<td>\" <button class='ed' onclick=\"openeForm('".$row['patient_id']."')\"
				>Edit<b class=\"plus\"><i class=\"fas fa-edit\"></i></b></button></td>
				<td>".$row['first_name']." ".$row['last_name']."</td>
				<td>".$row['DOB']."</td>
				<td>".$diff->format('%y')." Years " .$diff->format('%m')." months " .$diff->format('%d'). " days</td>
				<td>".$row['gender']."</td>
				<td>".$row['phone']."</td>
				<td>".$row['Allegies']."</td>
				<td>".$row['conditions']."</td>
				<td>".$row['medications']."</td>
			</tr>";

					}
				}
	?>


	<?php
	echo($_SESSION['user_id']);

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
	 	 if ($fn && $ln && $dob && $pn && $a && $c && $g && $m) { // If everything's OK...
			$q = "INSERT INTO patients(first_name,last_name,DOB,gender,phone,Allegies,conditions,medications,user_id) VALUES('$fn','$ln','$dob','$g',$pn,'$a','$c','$m',".$_SESSION['user_id'].")";
			$r = mysqli_query($dbc,$q) or trigger_error("Query: $q \n<br />MySQL Error: " .mysqli_error($dbc));
			if (mysqli_affected_rows($dbc)== 1) {
				$_SESSION['patient_id'] = mysqli_insert_id($dbc);
			}
		
				
			}
	
		
		}

	


			?>
		</table>
</body>
</html>