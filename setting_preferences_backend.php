<?php
include 'head.php';
include 'mysqli.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['phone'])){
			$ph = mysqli_real_escape_string($dbc,$_POST['phone']);
		}
		if(isset($_POST['auth'])){
			$auth = mysqli_real_escape_string($dbc,$_POST['auth']);
		}

		if($ph || $auth){
			$q = "UPDATE users SET phone='$ph',auth='$auth' WHERE user_id=".$_SESSION['user_id'].";";
			$r = mysqli_query($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " .mysqli_error($dbc));
			if(mysqli_affected_rows($dbc)>0){
				$url =  "settings.php?success=3";
				header("location:$url");
			
		}else{
			$url = "settings.php?e='The request could not be processed due to the syatem error.</br> Please try again later!'";
			header("location:$url");
		}
	}else{
		echo "Please fill in either the phone number or Two-factor authentication option to update any of them";
	}
}

	?>
</body>
</html>