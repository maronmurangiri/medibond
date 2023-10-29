<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		include 'head.php';
		$id == 39;
	?>
	<?php
		$q = "SELECT med.medicine_id,CONCAT('H',med.medicine_id) AS sku, c.quantity,c.user_session_id, med.medicine_name,med.price, med.stock, med.capacity FROM carts AS c INNER JOIN medicine AS med ON c.medicine_id=med.medicine_id  WHERE c.user_session_id=".$id.";"; 
		$r = mysqli_query($dbc,$q);
		if(mysqli_num_rows($r)>0){
	?>
	<form>
		<table>
			<tr>
				<th>Prescription</th>
				<th>Select Patient</th>
				<th>Select prescriber</th>
				<th>Select Your Medical Prescription source</th>
			</tr>
			<?php 
			while($row = mysqli_fetch_array($r,MYSQLI_ASSOC)){
			echo"<tr>
				<td>".$row['medicine_name']."</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>";
		}
	}
			?>
		</table>
	</form>
</body>
</html>