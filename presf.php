<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
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
		.pt{
			margin-top: 280px;
		}
	</style>
</head>
<body>
	<?php
		//$id;
		include 'head.php';
		include'mysqli.inc.php';
		$id = 39;
	?>
	<?php
		$q = "SELECT med.medicine_id,CONCAT('H',med.medicine_id) AS sku, c.quantity,c.user_session_id, med.medicine_name,med.price, med.stock, med.capacity,CONCAT_WS(' ',pres.last_name , pres.first_name) AS prescriber,pres.prescriber_id, CONCAT_WS(' ',pat.last_name , pat.first_name) AS patient FROM medicine AS med INNER JOIN carts AS c ON c.medicine_id=med.medicine_id INNER JOIN prescriber AS pres ON pres.user_id = c.user_session_id INNER JOIN patients AS pat ON pat.user_id = c.user_session_id WHERE c.user_session_id=".$id.";"; 
		$r = mysqli_query($dbc,$q);
		if(mysqli_num_rows($r)>0){

	?>
	<div class="pt">
		<form>
			<table>
				<tr>
					<th>Prescription</th>
					<th>Select Patient</th>
					<th>Select prescriber</th>
					<th>Select Your Medical Prescription source</th>
				</tr>
				<?php 
				echo "<tr><td><select id='cars' name='carlist'>";
				while($row = mysqli_fetch_array($r,MYSQLI_ASSOC)){
						echo"<option value='".$row['prescriber_id']."'>".$row['prescriber']."</option>
  								
							
						</td>
				<td>".$row['medicine_name']."</td>
						
							
  								
						<td></td>
						<td></td>
					</tr>";
				}
				echo "</select>";
		}
				?>
			</table>
		</form>
	</div>
</body>
</html>