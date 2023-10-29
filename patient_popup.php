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
.form-popupp {
  display: none;
  position: absolute;
  bottom: -260px;
  right: 500px;
  border: 0px solid #f1f1f1;
  z-index: 9;
  margin-left: -200px;
  margin-top: 60px;
}

/* Add styles to the form container */
.form-containerp {
  max-width: 300px;
  padding: 10px;
  background-color: white;
  //padding-bottom: 140px;
  //max-height: 1500px;
}

/* Full-width input fields */
.form-containerp input[type=text], .form-containerp input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-containerp input[type=text]:focus, .form-containerp input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-containerp .btn {
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
.form-containerp .cancel {
  background-color: red;
  //color: black;

}
.cancel:hover{
    opacity: 0.2;
}
/* Add some hover effects to buttons */
.form-containerp .btn:hover, .open-button:hover {
  opacity: 1;
}
.save{
    padding-left: 5px;
    font-size: 20px;
    margin-top: 4px;
}
.dob{
    width: 280px;
    height: 40px;
    background-color: #eeeeee;
    margin-bottom: 20px;
    border:none;
}
</style>
</head>
<body>
    <?php //include'home_login_popup.php'; 

    ?>

<div class="form-popupp" id="mypForm">
  <form action="patient.php" method="post" class="form-containerp">
    <h1><b style="padding-right: 10px;"><i  class="fas fa-plus"></i></b>Add patient</h1>

    <label for="first_name"><b>First Name</b></label>
    <input type="text" name="first_name" placeholder="Enter First Name" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name'];?>">

    <label for="last_name"><b>Last Name</b></label>
    <input type="text" name="last_name" placeholder="Enter Last Name" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name'];?>">
    <label for="dob"><b>Date of Birth(D.O.B)</b></label>
    <input type="date" class="dob" name="dob" placeholder="Date of Birth" value="<?php if(isset($_POST['dob'])) echo $_POST['dob'];?>" required>
    <input type="radio" id="male" name="gender" value="male" <?php if(isset($_POST['gender']) && ($_POST['gender'] =='male')){echo'checked="checked"';}?>>
  <label for="male">Male</label>
  <input type="radio" id="female" name="gender" value="female" <?php if(isset($_POST['gender']) && ($_POST['gender'] =='female')){echo'checked="checked"';}?>>
  <label for="female">Female</label><br><br>


    <label for="phone"><b>Phone Number</b></label>
    <input type="text" name="phone" placeholder="Enter Phone Number" value="<?php if(isset($_POST['phone'])) echo $_POST['phone'];?>">


    <label for="allergy"><b>Allergies</b></label>
    <input type="text" placeholder="Allergies" name="allergy" value="<?php if(isset($_POST['allergy'])) echo $_POST['allergy'];?>" required>

    <label for="conditions"><b>Conditions</b></label>
    <input type="text" placeholder="condition" name="conditions" value="<?php if(isset($_POST['conditions'])) echo $_POST['conditions'];?>" required>

    <label for="medications"><b>Other Medications</b></label>
    <input type="text" placeholder="Medications" name="medications" value="<?php if(isset($_POST['medications'])) echo $_POST['medications'];?>" required>
    <button type="submit" class="btn">Save<b class="save"><i class="far fa-save"></i></b></button>
    <button type="button" class="btn cancel" onclick="closepForm()">Back to Patients</button>
  </form>
</div>

<script>
function openpForm() {
  document.getElementById("mypForm").style.display = "block";
}

function closepForm() {
  document.getElementById("mypForm").style.display = "none";
}
</script>


</body>
</html>

