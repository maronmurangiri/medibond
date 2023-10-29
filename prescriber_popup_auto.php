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
.form-popuppu {
  display: none;
  position: absolute;
  bottom: -80px;
  right: 500px;
  border: 0px solid #f1f1f1;
  z-index: 9;
  margin-left: -200px;
  margin-top: 0px;
}

/* Add styles to the form container */
.form-containerpu {
  max-width: 400px;
  padding: 10px;
  background-color: white;
  //padding-bottom: 140px;
  //max-height: 1500px;
}

/* Full-width input fields */
.form-containerpu input[type=text], .form-containerpu input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-containerpu input[type=text]:focus, .form-containerpu input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-containerpu .btn {
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
.form-containerpu .cancel {
  background-color: red;
  //color: black;

}
.cancel:hover{
    opacity: 0.2;
}
/* Add some hover effects to buttons */
.form-containerpu .btn:hover, .open-button:hover {
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
.pm{
  margin-left: 5px;
  border:none;
  background-color: grey;
  color: white;
  text-align: center;
  padding: 5px;
  padding-top: 7px;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
  font-weight: bold;
}
.pm:hover{
  opacity: 1;
}
.se{
  margin-left: 300px;
  
  cursor: pointer;
}

}
</style>
</head>
<body>
    <?php include'prescriber_popup.php'; 

    ?>

<div class="form-popuppu" id="mypuForm">
  <form action="prescriber_auto.php" method="post" class="form-containerpu">
    <h1><b style="padding-right: 10px;"><i  class="fas fa-plus"></i></b>Add prescriber</h1>
    <hr>
    <h4>Let's see if we can find your prescriber for you first.</h4>
    <p>Please enter at least 2 characters for the First Name and Last Name, and ZIP Code of your prescriber.</p>

    <label for="first_name"><b>First Name</b></label>
    <input type="text" name="first_name" placeholder="Enter First Name" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name'];?>">

    <label for="last_name"><b>Last Name</b></label>
    <input type="text" name="last_name" placeholder="Enter Last Name" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name'];?>">
    
    

    <label for="phone"><b>ZIP code</b></label>
    <input type="text" name="zip" placeholder="ZIP code" value="<?php if(isset($_POST['zip'])) echo $_POST['zip'];?>">
    <div class="s"><button class="se">Search</button></div>


    <button type="submit" class="btn">Save<b class="save"><i class="far fa-save"></i></b></button>
    <button type="button" class="btn cancel" onclick="closepuForm()">Back to Patients</button>
  </form>
  <div class="pm"><button onclick="openpmForm(); closepuForm()" class="pm">Add my prescriber Manually</button></div>
</div>

<script>
function openpuForm() {
  document.getElementById("mypuForm").style.display = "block";
}

function closepuForm() {
  document.getElementById("mypuForm").style.display = "none";
}
</script>

</body>
</html>

