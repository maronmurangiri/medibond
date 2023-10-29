<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="drug-purchase.css">
	<style type="text/css">
		.cart{
			text-decoration: none;
}
.cartb{
	width: 200px;
	height: 30px;
	background-color: #14fa87;
	margin-left: -50px;
	text-align: center;
	//padding: 0px;
	font-size: 20px;
	color: white;
	padding-bottom: -2px;
	
}
.over{
	//border:2px solid blue;
	border: 2px dotted orange;
	padding-bottom: 20px;
	

}

	</style>
	<script>
		function myFunction() {
  				document.getElementById("overview").style.borderColor = "lightblue";
		}
</script>

</head>
<body>
	
	<?php

		require 'mysqli.inc.php';
		

		if($dbc === false){
   			 die("ERROR: Could not connect. " . mysqli_connect_error());
		}

		require 'head.php';
		
		if(isset($_GET['n'])){
			$id = $_GET['n'];
		}

		else{
			$url = 'home.php';
			header("location:$url");
		}
		
		$q = "SELECT * FROM medicine WHERE medicine_id = $id";
		$r = mysqli_query($dbc, $q);

		if(@mysqli_num_rows($r) == 1){
			while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
				include'login_popup.php';

				echo "<div class='name'>
						<p class = 'medicine_name'>".$row['medicine_name']."</p>
						<p class='price'>Ksh.".$row['price']."</p>
						<p>".$row['capacity']." </p>";
						if(isset($_SESSION['user_id'])){
							echo "<div class='cartb'>
									<p class='cart'><a class='cart'  href='cart.php?id=".$row['medicine_id']."&action=add'>Add to Cart <i class=\"fas fa-cart-plus\"></i></a></p>
									</div>";
						}else{
							echo "<div class='cartb'>
									<button class=\"cartb\" onclick=\"openlForm()\">Add to cart<i class=\"fa fa-cart-plus\" aria-hidden=\"true\"></i>
						}
						}
</button>

							</div> ";
						}
							
					
				
				echo "
					<div class='enc'>
						<div class='truck'><i class=\"fas fa-truck\"></i></div>
						<div class='shipp'>
							<p class='aff'>GET affordable</br> Shipping!</p>
							<p class='ord'>Order with Medibond and your prescriptions</br> will be shipped to your home for efficiently!</p>
						</div>
					</div>

				</div>";
				echo "

					<div class='linke'>Quick LInks</div>
					<div class='inte'>
						<p><a style='text-decoration:none; color:black;' href='#overview'>Overview</a></p>
						<p><a  style='text-decoration:none;' href='#precautions'>Precautions</a></p>
						<p><a  style='text-decoration:none;' href='#warning'>Warning</a></p>
						<p><a style='text-decoration:none;'  href='#side_effects'>side_effects</a></p>
						<p><a  style='text-decoration:none;' href='#interactions'>Interactions</a></p>
					</div>
					<div class='drug'>
						<div class='info'>Drug Information:</div>
						<div class=\"over\"><p id='overview' ><b>Overview </b></p> <p>".$row['overview']."</p></div></br>
						<div class=\"over\"><p id ='precautions'><b>Precautions </b></p><p>".$row['precautions']."</p></div></br>
						<div class=\"over\"><p id='warning'><b>Warning  </b></p><p>".$row['warning']."</p></div></br>
						<div class=\"over\"><div class=\"over\"><p id='side_effects'><b>Side Effects</b></p><p>".$row['side_effects']."</p></div></br>
						<div class=\"over\"><p id='interactions'><b>Interactions</b></p><p>".$row['interactions']."</p></div></br>
					</div>
				";
			}
		}
	?>
</body>
</html>

