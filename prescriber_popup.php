		<div class="form-popuppm" id="mypmForm">
  <form action="prescriber.php" method="post" class="form-containerpm">
    <h1><b style="padding-right: 10px;"><i  class="fas fa-plus"></i></b>Add prescriber</h1><hr>

    <label for="first_name"><b>First Name</b></label>
    <input type="text" name="first_name" placeholder="Enter First Name" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name'];?>">

    <label for="last_name"><b>Last Name</b></label>
    <input type="text" name="last_name" placeholder="Enter Last Name" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name'];?>">

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
    <button type="button" class="btn cancel" onclick="closepmForm()">Back to Patients</button>
  </form>
</div>

		<script>
function openpmForm() {
  document.getElementById("mypmForm").style.display = "block";
}

function closepmForm() {
  document.getElementById("mypmForm").style.display = "none";
}
</script>