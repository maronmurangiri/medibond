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
		if(isset($_POST['pass1'])){
			$p1 = mysqli_real_escape_string($dbc,$_POST['pass1']);
		}
		if(isset($_POST['pass2'])){
			$p2 = mysqli_real_escape_string($dbc,$_POST['pass2']);
		}
		if(isset($_POST['pass3'])){
			$p3 = mysqli_real_escape_string($dbc,$_POST['pass3']);
		}
	}

		if($p1 && $p2 && $p3){

			$q = "SELECT password FROM users WHERE user_id=".$_SESSION['user_id'].";";
			$r = mysqli_query($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " .mysqli_error($dbc));
			if(mysqli_num_rows($r)>0){
					while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
						
						if($p1 = $row['password']){

							if ($p2 = $p3) {
								$s = "UPDATE users SET password='$p2' WHERE user_id=".$_SESSION['user_id']." LIMIT 1";
								$t = mysqli_query($dbc,$s) or trigger_error("Query: $s\n<br />MySQL Error: " .mysqli_error($dbc));
								if(mysqli_affected_rows($dbc)>0){
								$url =  "settings.php?success=2";
								header("location:$url");
			
								}else{
									$url = "settings.php?e='The request could not be processed due to system error! </br> Please try again later!'";
									header("location:$url");
								}
							}
						}else{
							$url = "settings.php?e='Please enter the right old password!'";
							header("location:$url");
						}
					}
			}else{
				$url = "settings.php?e='The request could not be processed due to system error! </br> Please try again later!'";
				header("location:$url");
			}
			
		}else{
			echo "notset";
		}
	?>
</body>
</html>