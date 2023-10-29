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
		echo($_SESSION['user_id']);
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['email'])){
			$e = mysqli_real_escape_string($dbc,$_POST['email']);
		}

		if($e){
			$q = "UPDATE users SET email='$e' WHERE user_id=".$_SESSION['user_id']." LIMIT 1;";
			$r = mysqli_query($dbc,$q);
			if(mysqli_affected_rows($dbc)>0){
				$url =  "settings.php?success=1";
				header("location:$url");
			
		}else{
			$url = "settings.php?e='The request could not be processed due to system error! </br> Please try again later!'";
				header("location:$url");
		}
	}
}

	?>
</body>
</html>