<?php
include 'head.php';
include'mysqli.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
	.page{
		margin-top: 300px;
		background-color: white;

	}
	.key{
		font-size: 30px;
		color: green;
		cursor: pointer;
	}
	table, th, td{
 			 border: 1px solid black;
			 border-collapse: collapse;
			 margin-left: 30px;
			 margin-top: 30px;
		}
		th, td {
  			padding: 100px;
		}
		table {
  			border-spacing: 1px;
		
		}
</style>
<style type="text/css">
       .error{
        color: purple;
        font-weight: bold;
        text-align: center;
       }
   </style>
<script>
        function myFunction() {
                alert("Email changed Successfully!\n You will now be using the new email to access your account");
            }
    </script>
    <script>
        function mypFunction() {
                alert("Password Changed Successfully!\n You will now be using the new password to access your account");
            }
    </script>
    <script>
        function myspFunction() {
                alert("Security Preferences settings Updated Successfully!");
            }
    </script>
<body>
	<?php 
  
  if ( isset($_GET['success']) && $_GET['success'] == 1 )
{
     echo "<div style=\"background-color:green;\"><body onload=\"myFunction();\"></div";
}
?>
<?php 
  
  if ( isset($_GET['success']) && $_GET['success'] == 2 )
{
     echo "<div style=\"background-color:green;\"><body onload=\"mypFunction()\"></div";
}
?>
<?php 
  
  if ( isset($_GET['success']) && $_GET['success'] == 3 )
{
     echo "<div style=\"background-color:green;\"><body onload=\"myspFunction()\"></div";
}
?>
<?php 
      if(isset($_GET['e'])){
           echo "<p class=\"error\">".$_GET['e']."</p>";
         }
 ?>

	<?php
include"settings_popup.php";
//include 's_change_email.php';
//include'setting_preferences_popup.php';
	?>

<?php

	$q = "SELECT * FROM users WHERE user_id = ".$_SESSION['user_id'].";";
	$r = mysqli_query($dbc,$q) or trigger_error("Query: $q \n<br />MySQL Error: " .mysqli_error($dbc));
	if(mysqli_num_rows($r)> 0){
		while ($row = mysqli_fetch_array($r,MYSQLI_ASSOC)) {

				echo "<div class='page'>
					<h1 class=\"setting1\"><i class=\"fas fa-user-cog\"></i>Account Settings:  ".$row['email']." </h1>
					<div>
						<table>
							<tr>
								<th><button class=\"patient\" onclick=\"opencapForm()\"><b class='key'><i class=\"fas fa-key\"></i></b>Change Account Password</button></th>
								<th><button class=\"patient\" onclick=\"openceForm()\"><b class='key'><i class=\"fas fa-envelope-square\"></i></b>Change Email</button></th>
								<th><button class=\"patient\" onclick=\"openspForm()\"><b class='key'><i class=\"fas fa-user-lock\"></i></i></b>Security Preferences</button></th>
							</tr>
						</table>
					</div>

				<div>";
		}

	}else{
			
		}

	
	?>
</body>
</html>