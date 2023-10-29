<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.table{
			margin-top: 80px;
			margin-left: 20px;
		}
		.pres{
			margin-top: 320px;
			margin-left: 150px;
		}
		table {
  			border: 1px solid black;
  			border-collapse: collapse;

}
		th, td {
  			padding: 35px;
		}
		table {
  			border-spacing: 1px;

		}
		.name{
			width: 250px;
			height: 30px;
			text-align: center;
		}
		.submit{

		}

	</style>
</head>
<body>
	<?php include'head.php'; 
	require('./includes/config.inc.php');
	require(MYSQL);
	?>
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_POST['name'])){
				$name = mysqli_real_escape_string($dbc, $_POST['name']);
			}else{
				$name = FALSE;
			}
			if(isset($_POST['refill'])){
				$refill = mysqli_real_escape_string($dbc, $_POST['refill']);
			}else{
				$refill = FALSE;
			}
			if(isset($_POST['prescriber'])){
				$prescriber =mysqli_real_escape_string($dbc, $_POST['prescriber']);
			}else{
				$prescriber=FALSE;
			}
			if(isset($_POST['quantity'])){
				$quantity =mysqli_real_escape_string($dbc, $_POST['quantity']);
			}else{
				$quantity=FALSE;
			}

			//echo($_SESSION['user_id']);
			if($name || $refill || $prescriber || $quantity){
				echo($quantity);
				$q = "UPDATE prescription SET Prescription_drug_inf = '".$name."',refill_inf='".$refill."', prescriber='".$prescriber."',action=".$quantity." WHERE user_id=".$_SESSION['user_id'].";";
				$r = mysqli_query($dbc,$q) or trigger_error("Query: $q \n<br />MySQL Error: " .mysqli_error($dbc));

			}
		}
	?>
	<h3 class="pres">Prescriptions can be managed here once a pharmacist receives and reviews your prescription(s).</h3>
	<form action="prescription.php" method="post">
		<table class="table" cellspacing="15" cellpadding="10">
			<tr>
				<th>Prescription Drug Information</th>
				<th>Refill information</th>
				<th>Prescriber Information</th>
				<th>Quantity</th>
			</tr>
			<?php 
			echo($_SESSION['user_id']);
			$q = "SELECT * FROM prescription WHERE user_id = ".$_SESSION['user_id'].";";
			$r = mysqli_query($dbc,$q);
			if(mysqli_num_rows($r)>0){
				while ($row= mysqli_fetch_array($r, MYSQLI_NUM)) {
			echo'<tr>
				<td><input class="name" type="text" name="name" value="'.$row['1'].'" ></td>
				<td><input class="name" type="text" name="refill" placeholder="Kindly Update" value="'.$row['2'].'" ></td>
				<td><input class="name" type="text" name="prescriber" placeholder="Kindly Update" value="'.$row['3'].'" ></td>
				<td><input class="name" type="text" name="quantity" value="'.$row['4'].'"></td>
				

			</tr>';
		}
	}
		?>
			

		</table>
		<p align="center"><input  class="submit" type="submit" value="Update prescription"></p>
	</form>
</body>
</html>