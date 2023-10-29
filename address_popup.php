<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="form-popupa" id="myaForm">
	  <form action="address.php" method="post" class="form-containera">
    <h1><b style="padding-right: 10px;"><i  class="fas fa-plus"></i></b>Add address</h1><hr>

    <label for="address"><b>Street Address</b></label>
    <input type="text" class="" name="address" placeholder="Address" value="<?php if(isset($_POST['address'])) echo $_POST['address'];?>" required>


    <label for="city"><b>City</b></label>
    <input type="text" name="city" placeholder="city" value="<?php if(isset($_POST['city'])) echo $_POST['city'];?>">


    <label for="state"><b>County</b></label>
    <input type="text" placeholder="County" name="county" value="<?php if(isset($_POST['county'])) echo $_POST['county'];?>" required>

    <label for="conditions"><b>ZIP</b></label>
    <input type="text" placeholder="ZIP" name="zip" value="<?php if(isset($_POST['zip'])) echo $_POST['zip'];?>" required>

    <label for="Phone"><b>Phone</b></label>
    <input type="text" placeholder="Phone" name="phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone'];?>" required>
    <button type="submit" class="btn">Save<b class="save"><i class="far fa-save"></i></b></button>
    <button type="button" class="btn cancel" onclick="closeaForm()">Back to Patients</button>
  </form>
</div>

		<script>
function openaForm() {
  document.getElementById("myaForm").style.display = "block";
}

function closeaForm() {
  document.getElementById("myaForm").style.display = "none";
}
</script>
</body>
</html>