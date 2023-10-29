<?php

// This is the receipt page. 

// Require the configuration before any PHP code:
require('./includes/config.inc.php');

if (!isset($_GET['x'], $_GET['y']) || !filter_var($_GET['x'], FILTER_VALIDATE_INT,  array('min_range' => 1))) { // Redirect the user.
	$location = 'index.php';
	header("Location: $location");
	exit();
} else {
	$order_id = $_GET['x'];
	$email_hash = $_GET['y'];
}
//echo($order_id.SHA1($email_hash));
// Require the database connection:
require(MYSQL);

// Set the page title and include the header:
include('./includes/plain_header.html');

// Fetch the order information:
$q = 'SELECT FORMAT(total/100, 2) AS total, FORMAT(shipping/100,2) AS shipping, credit_card_number, DATE_FORMAT(order_date, "%a %b %e, %Y at %h:%i%p") AS od, email, CONCAT(last_name, ", ", first_name) AS name, CONCAT_WS(" ", address1, address2, city, state, zip) AS address, phone, med.medicine_name AS item, quantity, FORMAT(price_per/100,2) AS price_per FROM orders AS o INNER JOIN customers AS c ON (o.customer_id = c.id) INNER JOIN order_contents AS oc ON (oc.order_id = o.order_id) INNER JOIN medicine AS med ON (oc.product_id = med.medicine_id) WHERE o.order_id= ? AND md5(email)=?'; 
													

// Prepare the statement:
$stmt = mysqli_prepare($dbc, $q);
//echo($email_hash);
if($stmt == false) {
		die("<pre>".mysqli_error($dbc).PHP_EOL.$q."</pre>");
	}
// Bind the variables:
mysqli_stmt_bind_param($stmt, 'is', $order_id, $email_hash);

// Execute the query:
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
if (mysqli_stmt_num_rows($stmt) > 0) { // Display the order info:

	echo '<h3>Your Order</h3>';

	// Bind the result:
	mysqli_stmt_bind_result($stmt, $total, $shipping, $cc_num, $order_date, $email, $name, $address, $phone, $item, $quantity, $price);
		
	// Get the first row:
	mysqli_stmt_fetch($stmt);
//	echo($order_id);
	// Display the order and customer information:
	echo '<p><strong>Order ID</strong>: ' . $order_id . '</p><p><strong>Order Date</strong>: ' . $order_date . '</p><p><strong>Customer Name</strong>: ' . htmlspecialchars($name) . '</p><p><strong>Shipping Address</strong>: ' . htmlspecialchars($address) . '</p><p><strong>Customer Email</strong>: ' . htmlspecialchars($email) . '</p><p><strong>Customer Phone</strong>: ' . htmlspecialchars($phone) . '</p><p><strong>Credit Card Number Used</strong>: *' . $cc_num . '</p>';

	// Create the table:
	echo '<table border="0" cellspacing="3" cellpadding="3">
	<thead>
		<tr>
	    <th align="center">Item</th>
	    <th align="center">Quantity</th>
	    <th align="right">Price</th>
	    <th align="right">Subtotal</th>
	  </tr>
	</thead>
	<tbody>';
	
	// Print each item:
	do {
		
		// Create a row:
		echo '<tr>
		    <td align="left">' . $item . '</td>
		    <td align="center">' . $quantity . '</td>
		    <td align="right">$' . $price . '</td>
		    <td align="right">$' . number_format($price * $quantity, 2) . '</td>
		</tr>';
								
	} while (mysqli_stmt_fetch($stmt));

	// Show the shipping and total:
	echo '<tr>
	    <td align="right" colspan="3"><strong>Shipping</strong></td>
	    <td align="right">$' . $shipping . '</td>
	</tr>';
	echo '<tr>
	    <td align="right" colspan="3"><strong>Total</strong></td>
	    <td align="right">$' . $total . '</td>
	</tr>';

	// Complete the table and the form:
	echo '</tbody></table>';
	
} else { // No records returned!
	$failure = "Unable to INSERT into DB: " .mysqli_error($dbc);
	echo($failure);
	echo('fail');
	echo '<h3>Error!</h3><p>This page has been accessed in error.</p>';
}

include('./includes/plain_footer.html');
?>