<?php
		$q = "INSERT INTO prescription(Prescription_drug_inf,refill_inf,action) VALUES(".$name.",NULL,".$quantity.")";
		$r = mysqli_query($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " .mysqli_error($dbc));
     // End of WHILE loop. 

// Clear the stored procedure results:
mysqli_next_result($dbc);
?>
