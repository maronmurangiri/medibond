<?php
include 'head.php';
?><html>
<head>
	<title></title>
	<script>
        function myFunction() {
                alert("Patient Details Updated!");
            }
    </script>
	<style type="text/css">	
		body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
/*.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  //position: fixed;
  //bottom: 23px;
  //right: 28px;
  width: 280px;
}*/

/* The popup form - hidden by default */
.form-popuppm {
  display: none;
  position: absolute;
  bottom: -260px;
  right: 500px;
  border: 0px solid #f1f1f1;
  z-index: 9;
  margin-left: -200px;
  margin-top: 60px;
}

/* Add styles to the form container */
.form-containerpm {
  max-width: 300px;
  padding: 10px;
  background-color: white;
  //padding-bottom: 140px;
  //max-height: 1500px;
}

/* Full-width input fields */
.form-containerpm input[type=text], .form-containerpm input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-containerpm input[type=text]:focus, .form-containerpm input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-containerpm .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-containerpm .cancel {
  background-color: red;
  //color: black;

}
.cancel:hover{
    opacity: 0.2;
}
/* Add some hover effects to buttons */
.form-containerpm .btn:hover, .open-button:hover {
  opacity: 1;
}
.save{
    padding-left: 5px;
    font-size: 20px;
    margin-top: 4px;
}
.dob{
    width: 280px;
    height: 40px;
    background-color: #eeeeee;
    margin-bottom: 20px;
    border:none;
}
	



		.patient{
			background-color: green;
			color: white;
			padding: 5px;
			font-size: 20px;
			margin-top: 300px;
			margin-left: 1100px;
			border:none;
			//border-radius:50%;
		}
		.plusi{
			padding: 1px;
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
  			padding: 60px;
		}
		table {
  			border-spacing: 1px;
		
		}
		.tt{
			margin-left: 
		}

	</style>
</head>
<body>
	<?php
	if ( isset($_GET['success']) && $_GET['success'] == 1 )
{
     echo "<body onload=\"myFunction()\">";
}

		
		require 'mysqli.inc.php';
	 	 
	 	

		include 'prescriber_popup_auto.php';
		//include'edit_patient_popup.php';
		/*<i class="far fa-save"></i>
	<i class="fas fa-sign-in-alt"></i><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-right"></i>*/
	?>
	<button class="patient" onclick="openpuForm()">Add New Prescriber<b class="plusi"><i  class="fas fa-plus"></i></b></button>
	<div class="patients">
		<div class="use"><i class="fas fa-users"></i></div>
		<div class="patients1">Prescribers</div>	
		<div class="patients2">Click "Add New Prescriber" to add a new prescriber. Click "Edit" or "Delete" on a prescriber to edit their details or delete them.</div>
	</div>
	<?php

$t = "SELECT * FROM prescriber WHERE user_id = ".$_SESSION['user_id'].";";
				$k = mysqli_query($dbc, $t) or trigger_error("Query: $t \n<br />MySQL Error: " .mysqli_error($dbc));
				if(mysqli_num_rows($k)>0){
					echo "<table style=\"text-align:center;\" class=\"tt\">
			<tr>
				<th>delete</th>
				<th>Edit</th>
				<th>Name</th>
				<th>City</th>
				<th>State</th>
				<th>ZIP</th>
				<th>Phone Number</th>
				
			</tr>
			";
					while($row = mysqli_fetch_array($k,MYSQLI_ASSOC)){
							
			//$today = date("Y-m-d");
			//$diff = date_diff(date_create($row['DOB']), date_create($today));
					 

				echo "<tr>
				<td><a href='delete_prescriber.php?id=".$row['prescriber_id']."'>Delete</a></td>
				<td>\" <button class='ed' onclick=\"openeForm('".$row['prescriber_id']."')\"
				>Edit<b class=\"plus\"><i class=\"fas fa-edit\"></i></b></button></td>
				<td>".$row['first_name']." ".$row['last_name']."</td>
				<td>".$row['city']."</td>
				<td>".$row['state']."</td>
				<td>".$row['zip_code']."</td>
				<td>".$row['phone']."</td>
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
	 	 if (isset($_POST['address'])) {
	 	 	 $a = mysqli_real_escape_string($dbc, $_POST['address']);
	 	 } else {
	 	 	 echo '<p class="error">Please enter address!</p>';
	 	 }
	 	 if (isset($_POST['city'])) {
	 	 	 $c = mysqli_real_escape_string($dbc, $_POST['city']);
	 	 } else {
	 	 	 echo '<p class="error">Please enter the city of your practitioner!</p>';
	 	 }


	 	  if (isset($_POST['county'])) {
	 	 	 $s = mysqli_real_escape_string($dbc, $_POST['county']);
	 	 } else {
	 	 	 echo '<p class="error">Please enter the state of your practitioner!</p>';
	 	 }
	 	// Check for an email address:
	 	 if (isset($_POST['zip'])) {
	 	 	 $z = mysqli_real_escape_string($dbc, $_POST['zip']);
	 	 } else {
	 	 	 echo '<p class="error">Please enter the ZIP!</p>';


	 	 	 }
	
	 	 // Check for a password and match against the confirmed password:
	 	 if (isset($_POST['phone'])) {
	 	 	 $p = mysqli_real_escape_string($dbc, $_POST['phone']);
	 	 } else {
	 	 	 echo '<p class="error">Please enter the phone number!</p>';


	 	 	 }
	 	  

	 	echo($_SESSION['user_id']);
	 	 if ($fn && $ln && $a && $c && $s && $z && $p ) { // If everything's OK...
			$q = "INSERT INTO prescriber(last_name,first_name,address,city,state,zip_code,phone,user_id) VALUES('$ln','$fn','$a','$c','$s','$z','$p',".$_SESSION['user_id'].")";
			$r = mysqli_query($dbc,$q) or trigger_error("Query: $q \n<br />MySQL Error: " .mysqli_error($dbc));
			if (mysqli_affected_rows($dbc)== 1) {
				$_SESSION['prescriber_id'] = mysqli_insert_id($dbc);
				//$w = "INSERT INTO users(prescriber_id) VALUES($_SESSION['prescriber_id']) WHERE user_id = ".$_SESSION['user_id'].";";
			}
		
				
			}
	
		
		}

	


			?>
		</table>

</body>
</html>