<style>
    .change{
        margin-top : 200px;
    }
</style>

<?php

include('head.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
	 	 	 $e = mysqli_real_escape_string($dbc, $trimmed['email']);
	 	 } else {
	 	 	 echo '<p class="error">Please enter a valid email address!</p>';
	 	 	 }
	
	 	 // Check for a password and match against the confirmed password:
	 	 if (preg_match ('/^\w{4,20}$/', $trimmed['password1']) ) {
	 	 	 if ($trimmed['password1'] == $trimmed['password2']) {
	 	 	 	 $p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
	 	 	 } else {
	 	 	 	 echo '<p class="error">Your password did not match the confirmed password!</p>';
	 	 	 }
	 	 } else {
	 	 	 echo '<p class="error">Please enter a valid password!</p>';
	 	 }
	 	 if($p && $e){
	 	 	echo($e);
	 	 	echo($p);
	 	 }
}
?>
<div class = "change">
<form action="change__password.php" method="POST">
	<fieldset>
	 	<legend><b>Enter the new passowrd</b></legend>
	 	<p><b>Email Address:</b><input type='text' name='email' value = '<?php if(isset($_POST['email'])){ echo $_POST['email'];}?>'/></p>
	 	<p><b>Password :</b><input text='password' name = 'password1'/></p>
	 	<p><b> Confirm Password :</b><input text='password' name = 'password2'/></p>
	 </fieldset>
	 	<div align="center"><input type='submit'/></div>

</form>
</div>
