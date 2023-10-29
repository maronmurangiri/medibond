
<head>
		<style>
			body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
/*.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  //position: fixed;
  //bottom: 23px;
  //right: 28px;
  width: 280px;
}*/

/* The popup form - hidden by default */
.form-popupcap {
  display: none;
  position: absolute;
  bottom: -10px;
  right: 500px;
  border: 0px solid #f1f1f1;
  z-index: 9;
  margin-left: -200px;
  margin-top: 60px;
}


/* Add styles to the form container */
.form-containercap {
  max-width: 300px;
  padding: 10px;
  background-color: white;
  //padding-bottom: 140px;
  //max-height: 1500px;
}

/* Full-width input fields */
.form-containercap input[type=text], .form-containercap input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-containercap input[type=text]:focus, .form-containercap input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-containercap .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-containercap .cancel {
  background-color: red;
  //color: black;

}
.cancel:hover{
    opacity: 0.2;
}
/* Add some hover effects to buttons */
.form-containercap .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
<style type="text/css">
	.form-popupce {
  display: none;
  position: absolute;
  bottom: 30px;
  right: 500px;
  border: 0px solid #f1f1f1;
  z-index: 9;
  margin-left: -200px;
  //margin-top: 100px;
}


/* Add styles to the form container */
.form-containerce {
  max-width: 300px;
  padding: 10px;
  background-color: white;
  //padding-bottom: 140px;
  //max-height: 1500px;
  margin-top: -40px;
}

/* Full-width input fields */
.form-containerce input[type=text], .form-containerce input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-containerce input[type=text]:focus, .form-containerce input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-containerce .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-containerce .cancel {
  background-color: red;
  //color: black;

}
.cancel:hover{
    opacity: 0.2;
}
/* Add some hover effects to buttons */
.form-containerce .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
<style type="text/css">
	.form-popupsp {
  display: none;
  position: absolute;
  bottom: -200px;
  right: 500px;
  border: 0px solid #f1f1f1;
  z-index: 9;
  margin-left: -200px;
  margin-top: 20px;
  padding-top: 100px;
}

/* Add styles to the form container */
.form-containersp {
  max-width: 400px;
  padding: 10px;
  background-color: white;
  //padding-bottom: 140px;
  //max-height: 1500px;
  padding-top:;
  margin-top: 300px;
}

/* Full-width input fields */
.form-containersp input[type=text], .form-containersp input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-containersp input[type=text]:focus, .form-containersp input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-containersp .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-containersp .cancel {
  background-color: red;
  //color: black;

}
.cancel:hover{
    opacity: 0.2;
}
/* Add some hover effects to buttons */
.form-containersp .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
</head>
<body>
	<div class="form-popupcap" id="mycapForm">
<form action="s_change_password.php" method="post" class="form-containercap">
	<h2>Change Password</h2>
<p>Enter your old password and new password:</p>
	<label for="password"><b>Old Password</b></label>
	<input type="password" name="pass1" required>

	<label for="password"><b>New Password</b></label>
	<input type="password" name="pass2" required>

	<label for="password"><b>Confirm Password</b></label>
	<input type="password" name="pass3" required>
	<button type="submit" class="btn">Save<b class="save"><i class="far fa-save"></i></b></button>
    <button type="button" class="btn cancel" onclick="closecapForm()">Back to Settings</button>
</form>
</div>
<?php 
		$q ="SELECT * FROM users WHERE user_id=".$_SESSION['user_id'].";";
		$r = mysqli_query($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " .mysqli_error($dbc));
		if(mysqli_num_rows($r)>0){
			while($row = mysqli_fetch_array($r)){
					
			echo '<div class="form-popupcap" id="myceForm">
<form action="change_email_backend.php" method="post" class="form-containercap">
	<h2><i class="fas fa-envelope-square"></i> Change E-mail</h2><hr>
<h3>Current E-mail:</h3>
<p>'.$row['email'].'</p><hr>
<br>
<h3>Enter your new e-mail:</h3>
	<label for="email"><b>E-mail</b></label>
	<input type="text" placeholder="example@gmail.com" name="email" required>
	<button type="submit" class="btn">Save<b class="save"><i class="far fa-save"></i></b></button>
    <button type="button" class="btn cancel" onclick="closeceForm()">Back to Settings</button>
</form>
</div>


<div class="form-popupsp" id="myspForm">
	<form action="setting_preferences_backend.php" method="post" class="form-containersp">
	<h2>Current Settings</h2>
	<p>Mobile Phone number: '.$row['phone'].'</p>
	<p>Two-factor Authentication: '.$row['auth'].'</p><br><hr><br>
	<h2>Security Preferences Settings:</h2>
	<label for="phone"><b>Update Mobile phone number:</b></label>
	<input type="text" placeholder="phone" name="phone"><br>
	<h2>Two Factor Authentication:</h2>';
		}}
?>

	<p style="color: #080808;">Two factor authentication is a security feature that helps protect your account in addition to your password. If you set up two-factor authentication, you will be asked to enter a security code each time someone tries accessing from a device we don't recognize. To turn on the setting, just simply check the box below.</p>
	<label for="auth">Two factor Authentication:</label>

	<input type="radio" id="enabled" name="auth" value="enabled" <?php if(isset($_POST['auth']) && ($_POST['auth'] =='enabled')){echo'checked="checked"';}?>>
  <label for="enabled">Enabled</label>
  <input type="radio" id="disabled" name="auth" value="disabled" <?php if(isset($_POST['auth']) && ($_POST['auth'] =='disabled')){echo'checked="checked"';}?>>
  <label for="disabled">Disabled</label><br><br>

	<button type="submit" class="btn">Save<b class="save"><i class="far fa-save"></i></b></button>
    <button type="button" class="btn cancel" onclick="closespForm()">Back to settings</button>
</form>
</div>

<script>
function opencapForm() {
  document.getElementById("mycapForm").style.display = "block";
}

function closecapForm() {
  document.getElementById("mycapForm").style.display = "none";
}
</script>

<script>
function openceForm() {
  document.getElementById("myceForm").style.display = "block";
}

function closeceForm() {
  document.getElementById("myceForm").style.display = "none";
}
</script>

<script>
function openspForm() {
  document.getElementById("myspForm").style.display = "block";
}

function closespForm() {
  document.getElementById("myspForm").style.display = "none";
}
</script>
</body>