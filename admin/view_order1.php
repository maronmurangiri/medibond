<?php

// This file allows the administrator to view a specific order.
// The administrator can also mark order items as shipped.


// Require the configuration before any PHP code as configuration controls error reporting.
require('../includes/config.inc.php');
require('includes/header.php');


// Set the page title and include the header:
$page_title = 'View An Order';
//include('./includes/header.phpl');
// The header file begins the session.

// Validate the order ID:
$order_id = false;
if (isset($_GET['oid']) && (filter_var($_GET['oid'], FILTER_VALIDATE_INT, array('min_range' => 1))) ) { // First access
	$order_id = $_GET['oid'];
	$_SESSION['order_id'] = $order_id;
} elseif (isset($_SESSION['order_id']) && (filter_var($_SESSION['order_id'], FILTER_VALIDATE_INT, array('min_range' => 1))) ) {
	$order_id = $_SESSION['order_id'];
}
echo($order_id);
// Stop here if there's no $order_id:
if (!$order_id) {
	//echo '<h3>Error!</h3><p>This page has been accessed in error.</p>';
	include('./includes/footer.html');
	exit();
}

// Require the database connection:
require(MYSQL);

// ------------------------
// Process the payment!

// Check for a form submission:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {	
	
	// Need to process payment, record the transaction, update the order_contents table, and update the inventory.
	echo($order_id);
	// Get the order information:
	$q = "SELECT customer_id, total,response_code,response_reason, id FROM orders AS o JOIN transactions AS t ON (o.order_id=t.order_id AND t.type='auth_only' AND t.response_code=1) WHERE o.order_id=$order_id";

	$res = 1;
	$r = mysqli_query($dbc, $q);

	if (mysqli_num_rows($r) === 1) {
		
		// Get the returned values:
		list($customer_id, $order_total, $code,$reason,$trans_id) = mysqli_fetch_array($r, MYSQLI_NUM);
		
		// Check for a positive order total:
		if ($order_total > 0) {
			
			// Make the request to the payment gateway:
	
			
 			$q = "SELECT response_code,response_reason FROM transactions WHERE order_id=$order_id";
 			$r = mysqli_query($dbc,$q);
 			
 		//	$res = 1;
 			while ($row = mysqli_fetch_array($r,MYSQLI_ASSOC)) {

 					
 				if($row['response_code'] == $res ){

 				
 			echo($row['response_code']);
 					if($code == $res){



 			echo($code);

			// Record the transaction:
			$r = mysqli_query($dbc, "CALL add_transaction($order_id, '{$response->transaction_type}', $order_total, {$response->response_code}, '$reason', {$response->transaction_id}, '$full_response')");				
			
			// Upon success, update the order and the inventory:
			if ($response->approved) {
				
				$message = 'The payment has been made. You may now ship the order.';
					
				// Update order_contents:
				$q = "UPDATE order_contents SET ship_date=NOW() WHERE order_id=$order_id";
				$r = mysqli_query($dbc, $q);
	
				// Update the inventory...
				$q = 'UPDATE medicine AS med, order_contents AS oc SET med.stock=med.stock-oc.quantity WHERE med.medicine_id=oc.product_id  AND oc.order_id=' . $order_id;
				$r = mysqli_query($dbc, $q);
								
			} else { // Do different things based upon the response:
				
				$error = 'The payment could not be processed because: ' . $row['response_reason'].';';

			} // End of payment response IF-ELSE.
		

		} else { // Invalid order total!

				$error = "The order total (\$$order_total) is invalid.";

		} // End of $order_total IF-ELSE.

	} else { // No matching order!
		
		$error = 'No matching order could be found.';
		
	} // End of transaction ID IF-ELSE.
	
	// Report any messages or errors:
	echo '<h3>Order Shipping Results</h3>';
	if (isset($message)) echo "<p>$message</p>";
	if (isset($error)) echo "<p class=\"error\">$error</p>";

} // End of the submission IF.

// Above code added as part of payment processing.
// ------------------------

// Define the query:

$q = 'SELECT FORMAT(total/100, 2) AS total, FORMAT(shipping/100,2) AS shipping, credit_card_number, DATE_FORMAT(order_date, "%a %b %e, %Y at %h:%i%p") AS od, email, CONCAT(last_name, ", ", first_name) AS name, CONCAT_WS(" ", address1, address2, city, state, zip) AS address, phone, customer_id, CONCAT_WS("-",med.product_type,s.size,med.medicine_name) AS item, med.stock, quantity, FORMAT(price_per/100,2) AS price_per, DATE_FORMAT(ship_date, "%b %e, %Y") AS sd FROM orders AS o INNER JOIN customers AS c ON (o.customer_id = c.id) INNER JOIN order_contents AS oc ON (oc.order_id = o.order_id) INNER JOIN medicine AS med ON (oc.product_id = med.medicine_id)INNER JOIN sizes AS s ON (s.id=med.size_id) WHERE o.order_id= '.$order_id.';';
//UNION
//  SELECT FORMAT(total/100, 2), FORMAT(shipping/100,2), credit_card_number, DATE_FORMAT(order_date, "%a %b %e, %Y at %l:%i%p"), email, CONCAT(last_name, ", ", first_name), CONCAT_WS(" ", address1, address2, city, state, zip), phone, customer_id, CONCAT_WS("-",cc.product_type,s.size,med.medicine_name) AS item, med.stock, quantity, FORMAT(price_per/100,2), DATE_FORMAT(ship_date, "%b %e, %Y") FROM orders AS o INNER JOIN customers AS c ON (o.customer_id = c.id) INNER JOIN order_contents AS oc ON (oc.order_id = o.order_id) INNER JOIN medicine AS med ON (oc.product_id = med.medicine_id AND oc.product_type="veterinary medicine") INNER JOIN sizes AS s ON (s.id=med.size_id) INNER JOIN category AS cc ON (c.id = med.product_id)  WHERE o.order_id=' . $order_id.';';
// Execute the query:
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) > 0) { // Display the order info:

	echo '<h3>View an Order</h3>
	<form action="view_order.php" method="post" accept-charset="utf-8">
		<fieldset>';
		
	// Get the first row:
	$row = mysqli_fetch_array($r, MYSQLI_ASSOC);

	// Display the order and customer information:
	echo '<p><strong>Order ID</strong>: ' . $order_id . '<br /><strong>Total</strong>: $' . $row['total'] . '<br /><strong>Shipping</strong>: $' . $row['shipping'] . '<br /><strong>Order Date</strong>: ' . $row['od'] . '<br /><strong>Customer Name</strong>: ' . htmlspecialchars($row['name']) . '<br /><strong>Customer Address</strong>: ' . htmlspecialchars($row['address']) . '<br /><strong>Customer Email</strong>: ' . htmlspecialchars($row['email']) . '<br /><strong>Customer Phone</strong>: ' . htmlspecialchars($row['phone']) . '<br /><strong>Credit Card Number Used</strong>: *' . $row['credit_card_number'] . '</p>';

	// Create the table:
	echo '<table border="0" width="100%" cellspacing="8" cellpadding="6">
	<thead>
		<tr>
	    <th align="center">Item</th>
	    <th align="right">Price Paid</th>
	    <th align="center">Quantity in Stock</th>
	    <th align="center">Quantity Ordered</th>
	    <th align="center">Shipped?</th>
	  </tr>
	</thead>
	<tbody>';
	
	// For confirming that the order has shipped:
	$shipped = true;
	
	// Print each item:
	do {
		
		// Create a row:
		echo '<tr>
		    <td align="left">' . $row['item'] . '</td>
		    <td align="right">' . $row['price_per'] . '</td>
		    <td align="center">' . $row['stock'] . '</td>
		    <td align="center">' . $row['quantity'] . '</td>
		    <td align="center">' . $row['sd'] . '</td>
		</tr>';
		
		if (!$row['sd']) $shipped = false;
						
	} while ($row = mysqli_fetch_array($r));
	
	// Complete the table and the form:
	echo '</tbody></table>';
	
	// Only show the submit button if the order hasn't already shipped:
	if (!$shipped) {
		echo '<div class="field"><p class="error">Note that actual payments will be collected once you click this button!</p><input type="submit" value="Ship This Order" class="button" /></div>';	
	}
		
	// Complete the form:
	echo '</fieldset>
	</form>';

} else { // No records returned!
	$failure = "Unable to INSERT into DB: " .mysqli_error($dbc);
	echo($failure);
	echo '<h3>Error!</h3><p>This page has been accessed in error.</p>';
	include('./includes/footer.html');
	exit();	
}

include('./includes/footer.html');
?>