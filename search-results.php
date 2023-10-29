<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="search-result.css">
	<style type="text/css">
		.d1{
			background-color: white;
		}
	</style>

</head>
<body>
	<?php
	require ('mysqli.inc.php');
 
// Check connection
if($dbc === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

	require 'head.php';

		if(isset($_GET['n'])){
			$id = $_GET['n'];
		}
		else{
			$url = 'index.php';
			header("location:$url");
		}
	
		$q = "SELECT * FROM medicine WHERE medicine_id = $id";
		$r = mysqli_query($dbc, $q);

		//$src = 'drugs/a1';

		if(@mysqli_num_rows($r) == 1){
			while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
				
				if($row['nature_id']==1){
					$src = 'drugs/b51a.png';
				}
				elseif($row['nature_id']==2){
					$src ='drugs/b41a.png';
				}
				else{
					$src ='drugs/b51a.png';
				}
				echo'<div class="results">
						<p class="d1"><img class="d1" src="'.$src.'" height="280px"; width="200px;"/></p>
						<p class="medicine_name"><a href="drug-purchase.php?n='.$row['medicine_id'].'" style="text-decoration: none;"><u>'.$row['medicine_name'].' </u></a></p>
						<p class="price">Ksh.'.$row['price'].',<span class="capsules">'.$row['capacity'].'</span></p>
						<p class="general">General Discription:</p>
						<p class="overview">'.$row['overview'].'</p>
					</div>';
			}
		}
	

?>

</body>
</html>