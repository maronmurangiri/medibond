<div class="form-popupcap" id="myceForm">
<form action="" method="post" class="form-containercap">
	<h2><i class="fas fa-envelope-square"></i> Change E-mail</h2><hr>
<h3>Current E-mail:</h3>
<p><?php echo($_row['email']);?></p><hr>
<br>
<h3>Enter your new e-mail:</h3>
	<label for="email"><b>E-mail</b></label>
	<input type="text" placeholder="example@gmail.com" name="email">
	<button type="submit" class="btn">Save<b class="save"><i class="far fa-save"></i></b></button>
    <button type="button" class="btn cancel" onclick="closeceForm()">Back to Patients</button>
</form>
</div>

<script>
function openceForm() {
  document.getElementById("myceForm").style.display = "block";
}

function closeceForm() {
  document.getElementById("myceForm").style.display = "none";
}
</script>