<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="index1.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
		<style type="text/css">
				.inf{
					margin-left: 1250px;
					font-weight: bold;
					background-color: #32305e;
				}
				.name{
					text-align: center;
					color:#07dcf0;
				}
				.loggin{
					color: #26f007;
				}
				.udash{
					margin-top: 220px;
				}
				.dashboard{
					margin-left: -960px;
				}
				
				
		</style>
		<?php include 'head.php'; ?>
</head>
<body class="body">
		<?php 
	
	 // Include the configuration file:
	 require ('includes/config.inc.php');
	
	 // Set the page title and include the HTML header:
	 $page_title = 'Welcome to this Site!';
	 
	 // Welcome the user (by name if they are logged in):
	 echo "<div class='inf'><div class=\"loggin\">Logged in as</div>";
	 if (isset($_SESSION['first_name'])) {
	 	 echo" <div class='name'>{$_SESSION['first_name']}</div>
	 	 </div>";
	 }
	 else{echo "fail";}
	 
	 ?>
	 		<div class="udash">
					<div class="dashboard"><h1>User Dashboard</h1></div>
					<div class="tile">Click a tile to view, add, edit, or delete for each category.</div>
					<div class="user"><i class="fas fa-user"></i></div>
			</div>
			<div class="prescription">
					<a href="prescription.php" style="text-decoration: none;"><p class="medical"><i class="fas fa-file-medical"></i></p>
					<p class="prescription1">Prescriptions</p>
					<p class="prescription2">View your prescriptions</p></a>
			</div>
			<div class="patient">
					<a href="patient.php" style="text-decoration: none;"><p class="patients"><i class="fas fa-users"></i></p>
					<P class="patient1" >Patients</P>
					<p class="patient2">View/add/edit<br>all patients</p></a>
			<!--<p class="patient2">View/add/edit</p>
			<p class="patient3">all patients</p>-->
			</div>
			<div class="order">
					<a href="vorder.php" style="text-decoration:none;"><p class="dollar"><i class="fas fa-file-invoice-dollar"></i></i></p>
					<p class="order1">Orders</p>
					<p class="order2">View current <br> and past Orders</p></a>
			</div>
			<div class="prescriber">
					<a href="prescriber.php" style="text-decoration: none;"><p class="prescriber1"><i class="fas fa-user-md"></i></p>
					<p class="prescriber2">Prescribers</p>
					<p class="prescriber3">View/add/edit<br>all prescribers</p></a>
			</div>
		<div class="address">
			<a href="address.php" style="text-decoration: none"><p class="address1"><i class="fas fa-truck-moving"></i></p>
			<p class="address2">Addresses</p>
			<p class="address3">View/add/edit addresses</p></a>
		</div>
		<div class="payment">
			<p class="payment1"><i class="fas fa-money-check"></i></p>
			<p class="payment2">Payments</p>
			<p class="payment3">View/add/edit Payment forms</p>
		</div>
		<div class="setting">
			<a href="settings.php" style="text-decoration: none;"><p class="setting1"><i class="fas fa-user-cog"></i></p>
			<p class="setting2">Settings</p>
			<p class="setting3">Change account Settings.</p></a>

		</div>
	
	 <?php
	 		 //include ('foot.php');
	 ?>
	</div>
</body>
</html>
 