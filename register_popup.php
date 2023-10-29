<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
.form-popups {
  display: none;
  position: absolute;
  bottom: -240px;
  right: 500px;
  border: 0px solid #f1f1f1;
  z-index: 9;
  margin-left: -200px;
  margin-top: 60px;
}

/* Add styles to the form container */
.form-containers {
  max-width: 300px;
  padding: 10px;
  background-color: white;
  padding-bottom: 140px;
  //max-height: 1500px;
}

/* Full-width input fields */
.form-containers input[type=text], .form-containers input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-containers input[type=text]:focus, .form-containers input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-containers .btn {
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
.form-containers .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-containers .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
</head>
<body>
	<?php //include'home_login_popup.php'; ?>

<div class="form-popups" id="myhForm">
  <form action="register.php" method="post" class="form-containers">
    <h1>Sign Up</h1>

    <label for="first_name"><b>First Name</b></label>
    <input type="text" name="first_name" placeholder="Enter First Name" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name'];?>">

    <label for="last_name"><b>Last Name</b></label>
    <input type="text" name="last_name" placeholder="Enter Last Name" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name'];?>">

    <label for="phone"><b>Phone Number</b></label>
    <input type="text" name="phone" placeholder="Enter Phone Number" value="<?php if(isset($_POST['phone'])) echo $_POST['phone'];?>">

    <input type="hidden" name="auth" value="disabled">

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" required>

    <label for="password1"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password1" value="<?php if(isset($_POST['password1'])) echo $_POST['password1'];?>" required>

    <label for="password2"><b>Confirm Password</b></label>
    <input type="password" placeholder="Enter Password" name="password2" value="<?php if(isset($_POST['password2'])) echo $_POST['password2'];?>" required>
    <button type="submit" class="btn">Register</button>
    <button type="button" class="btn cancel" onclick="closehForm()">Cancel</button>
  </form>
</div>


	
<script>
function openhForm() {
  document.getElementById("myhForm").style.display = "block";
}

function closehForm() {
  document.getElementById("myhForm").style.display = "none";
}
</script>


</body>
</html>
