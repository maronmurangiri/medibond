
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.table{
			margin-top: 40px;
			margin-right: 5px;
			margin-left: 5px;
			tex
		}
		
		table, th, td{
 			 border: 1px solid black;
			 border-collapse: collapse;
		}
		th, td {
  			padding: 30px;
		}
		table {
  			border-spacing: 1px;

		}
		.cc{
			//width: 20px;
		}
		.h3{
			margin-top: 300px;
			text-align: center;
		}
	</style>
</head>
<body>
	<?php
	include 'head.php';
	require('./includes/config.inc.php');
	require(MYSQL);
	
echo($_SESSION['order_id']);

$q = 'SELECT FORMAT(total/100, 2) AS total, FORMAT(shipping/100,2) AS shipping, credit_card_number, DATE_FORMAT(order_date, "%a %b %e, %Y at %h:%i%p") AS od, email, CONCAT(last_name, ", ", first_name) AS name, CONCAT_WS(" ", address1, address2, city, state, zip) AS address, phone, customer_id, med.medicine_name AS item, med.stock, quantity, FORMAT(price_per/100,2) AS price_per, DATE_FORMAT(ship_date, "%b %e, %Y") AS sd FROM orders AS o INNER JOIN customers AS c ON (o.customer_id = c.id) INNER JOIN order_contents AS oc ON (oc.order_id = o.order_id) INNER JOIN medicine AS med ON (oc.product_id = med.medicine_id)INNER JOIN sizes AS s ON (s.id=med.size_id) WHERE o.order_id= '.$_SESSION['order_id'].';';
?>
<table class="table">
	<h3 class="h3">View of <?php echo($_SESSION['first_name']); ?>'s current and past Orders</h3>
	<tr>
		<th>Order ID</th>
		<th>Item Ordered</th>
		<th>Item's Price</th>
		<th>Quantity Ordered</th>
		<th>Shipping cost</th>
		<th>Total cost of the item</th>
		<th>Order Date</th>
		<th class="cc">Credit Card Number Used</th>
	</tr>
	<?php 
		$r = mysqli_query($dbc,$q) or trigger_error("Query: $q \n<br />MySQL Error: " .mysqli_error($dbc));

		if(mysqli_num_rows($r)>0){
			while ($row = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
				echo "<tr>
						<td align='center'>".$_SESSION['order_id']."</td>
						<td align='center'>".$row['item']."</td>
						<td align='center'>".$row['price_per']."</td>
						<td align='center'>".$row['quantity']."</td>
						<td align='center'>".$row['shipping']."</td>
						<td align='center'>".$row['total']."</td>
						<td align='center'>".$row['od']."</td>
						<td align='center'>".$row['credit_card_number']."</td>
					</tr>";
			}
		}


	?>
	
</table>
</body>
</html>