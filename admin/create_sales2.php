<?php

// Require the configuration before any PHP code as configuration controls error reporting.
require('../includes/config.inc.php');

// Set the page title and include the header:
$page_title = 'Create Sales';
include('includes/header.php');
// The header file begins the session.

// Require the database connection:
require(MYSQL);

// Check for a form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {	
	/*if(isset($_POST['sale_price'])){
		$sale = $_POST['sale_price'];
		echo($_POST['sale_price']);
	}*/
	if(!empty($_POST['sale_price'])){
		$sp = $_POST['sale_price'];
	}
	else{
		echo "Please enter the sale_price";
	}
	if (!empty($_POST['start_date'])) {
		$sd = $_POST['start_date'];
	}
	else{
		echo "enter the sale date";

	}
	if (!empty($_POST['end_date'])) {
		$ed = $_POST['end_date'];
	}
	if (!empty($_POST['medicine_id'])) {
		$mid = $_POST['medicine_id'];
	}else{
		echo "enter the id";
	}
	/*else{
		echo"No sale price";
	}*/
	/*if(isset($_POST['start_date'])){
		$sd = $_POST['start_date'];
	}
	else{
		echo"No start_date";
	}
	if (isset($_POST['end_date'])) {
		$ed =$_POST['end_date'];
	}
	if (isset($_POST['medicine_id'])) {
		$id = $_POST['medicine_id'];
	}*/
	//echo($sale); echo($id);
    /*$q = "INSERT INTO sales(price,start_date,end_date,medicine_id) VALUES(".$sp.",".$sd.",".$ed.",".$mid.")";
	$r = mysqli_query($dbc, $q);
	if(mysqli_affected_rows($dbc) == 1){
		echo "success";
	}
	else{
		echo "fail";
	}*/
	//print_r($sale);
	
	// Make sure these variables are set:
	if (isset($sp, $sd, $ed,$mid)) {
		
		// Need the product functions:
	require('../includes/product_functions.inc.php');
		
		// Prepare the query to be run:
		$q = 'INSERT INTO sales(medicine_id, price, start_date, end_date) VALUES (?, ?, ?, ?)';
		$stmt = mysqli_prepare($dbc, $q);
		echo($sd);
		mysqli_stmt_bind_param($stmt, 'iiss', $mid, $sp, $sd, $ed);

		// Count the number of affected rows:
		$affected = 0;

		// Loop through each provided value:
	//	foreach ($sp as $sku => $price) {
			//echo($price);
			// Validate the price and start date:
			if (filter_var($sp, FILTER_VALIDATE_FLOAT)&& ($sp > 0)&& (!empty($_POST['start_date'])))
			{
				echo($sp);
				// Parse the SKU:
			//	list($type, $id) = parse_sku($sku);
				//echo($type);echo($id);
				// Get the dates:
				$start_date = $_POST['start_date'];
				$end_date = (!empty($_POST['end_date']) && preg_match('/^(201)[3-9]\-[0-1]\d\-[0-3]\d$/', $_POST['end_date'])) ? $_POST['end_date'] : NULL;

				// Convert the price
				$sp = $sp*100;
				//echo($price);
				// Execute the query:
				mysqli_stmt_execute($stmt);
				if(mysqli_stmt_affected_rows($stmt)>0){
					echo (mysqli_insert_id($dbc));

				$affected += mysqli_stmt_affected_rows($stmt);
				}
				else{
					echo "maron failed";
				}
			} // End of price/date validation IF.
						
	//	} // End of FOREACH loop.
		
		// Indicate the results:
		echo "<h4>$affected Sales Were Created!</h4>";
							echo (mysqli_insert_id($dbc));
	} // $_POST variables aren't set.

} // End of the submission IF.*/

?>

<h3>Create Sales</h3>
<p>To mark an item as being on sale, indicate the sale price, the date the sale starts, and the date the sale ends. <strong>All dates must be in the format YYYY-MM-DD.</strong> You may leave the end date blank, thereby creating an open-ended sale. Only the currently stocked products are listed below!</p>
<form action="create_sales.php" method="post" accept-charset="utf-8">

	<fieldset>

<table border="0" width="100%" cellspacing="4" cellpadding="6">
	<thead>
	<tr>
		<th align="center">Item</th>
		<th align="center">Normal Price</th>
		<th align="center">Quantity in Stock</th>
		<th align="center">Sale Price</th>
		<th align="center">Start Date</th>
		<th align="center">End Date</th>
	</tr>
	</thead>
	<tbody>

<?php // Retrieve every in stock product:
$q = '(SELECT med.medicine_id,med.medicine_name AS name, FORMAT(med.price/100, 2) AS price, med.stock FROM medicine AS med WHERE med.stock>0 ORDER BY medicine_name)';
$r = mysqli_query($dbc, $q);
while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
	echo '<tr>
    <td align="right">' . htmlspecialchars($row['name']) . '</td>
    <td align="center">' . $row['price'] .'</td>
    <td align="center">' . $row['stock'] .'</td>
    <td align="center"><input type="text" name="sale_price" class="small"/></td>
	<td align="center"><input type="date" name="start_date" class="calendar" /></td>
	<td align="center"><input type="date" name="end_date"  class="calendar" /></td>
	<td align="center"><input type="hidden" name="medicine_id" value="'.$row['medicine_id'].'" class="calendar" /></td>
  </tr>';
}
?>
	</tbody></table>
	<div class="field"><input type="submit" value="Add These Sales" class="button" /></div>
	</fieldset>
</form>
<link href="/css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery-ui-1.10.3.custom.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(function() {
	$(".calendar").datepicker({dateFormat: "yy-mm-dd", minDate:0});
});
</script>

<?php
include('./includes/footer.html');
?>