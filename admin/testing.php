<?php
require('./includes/config.inc.php');
require(MYSQL);

// Check for a form submission:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {	
	
	// Make sure these variables are set:
	if (isset($_POST['sale_price'], $_POST['start_date'], $_POST['end_date'])) {
		
		// Need the product functions:

	require('../includes/product_functions.inc.php');
		

$affected = 0;

		// Loop through each provided value:
		foreach ($_POST['sale_price'] as $sku => $price) {
		//echo($type);
			// Validate the price and start date:
			if (filter_var($price, FILTER_VALIDATE_FLOAT) 
			&& ($price > 0)
			&& (!empty($_POST['start_date'][$sku]))
			&& (preg_match('/^(201)[3-9]\-[0-1]\d\-[0-3]\d$/', $_POST['start_date'][$sku]))
			){
				
				// Parse the SKU:
				list($type, $id) = parse_sku($sku);
				echo($type);
				echo($price);
				// Get the dates:
				$start_date = $_POST['start_date'][$sku];
				$end_date = (!empty($_POST['end_date'][$sku]) && preg_match('/^(201)[3-9]\-[0-1]\d\-[0-3]\d$/', $_POST['end_date'][$sku])) ? $_POST['end_date'][$sku] : NULL;

				// Convert the price
				$price = $price*100;


/*require(MYSQL);
$q = 'SELECT FORMAT(total/100, 2) AS total, FORMAT(shipping/100,2) AS shipping, credit_card_number, DATE_FORMAT(order_date, "%a %b %e, %Y at %h:%i%p") AS od, email, CONCAT(last_name, ", ", first_name) AS name, CONCAT_WS(" ", address1, address2, city, state, zip) AS address, phone, CONCAT_WS(" - ", oc.product_type, med.medicine_name) AS item, quantity, FORMAT(price_per/100,2) AS price_per FROM orders AS o INNER JOIN customers AS c ON (o.customer_id = c.id) INNER JOIN order_contents AS oc ON (oc.order_id = o.order_id) INNER JOIN medicine AS med ON (oc.product_id = med.medicine_id AND oc.product_type="Human medicine")  WHERE o.id=? AND SHA1(email)=?
UNION 																								
SELECT FORMAT(total/100, 2), FORMAT(shipping/100,2) , credit_card_number, DATE_FORMAT(order_date, "%a %b %e, %Y at %l:%i%p"), email, CONCAT(last_name, ", ", first_name), CONCAT_WS(" ", address1, address2, city, state, zip), phone, CONCAT_WS(" - ", oc.product_type, s.size, med.medicine_name) AS item, quantity, FORMAT(price_per/100,2)  FROM orders AS o INNER JOIN customers AS c ON (o.customer_id = c.id) INNER JOIN order_contents AS oc ON (oc.order_id = o.order_id) INNER JOIN medicine AS med ON (oc.product_id = med.medicine_id AND oc.product_type="veterinary medicine") INNER JOIN sizes AS s ON (s.id=med.size_id) WHERE o.id=? AND SHA1(email)=?';

// Prepare the statement:
$stmt = mysqli_prepare($dbc, $q);
// Bind the variables:
//$order_id = 4;
//$email_hash = 'murangirimaron@gmail.com';
mysqli_stmt_bind_param($stmt, 'isis', $order_id, $email_hash,$order_id,$email_hash);
$order_id = 4;
$email_hash = 'murangirimaron@gmail.com';
// Execute the query:
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
if (mysqli_stmt_num_rows($stmt) > 0) { // Display the order info:

	echo '<h3>Your Order</h3>';

	// Bind the result:
	mysqli_stmt_bind_result($stmt, $total, $shipping, $cc_num, $order_date, $email, $name, $address, $phone, $item, $quantity, $price);
		
	// Get the first row:
	mysqli_stmt_fetch($stmt);

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
	echo '<h3>Error!</h3><p>This page has been accessed in error.</p>';
}

include('./includes/plain_footer.html');
?>
//phpversion();

//phpinfo();https://packagist.org/packages/authorizenet/authorizenet
/*
include './includes/config.inc.php';
include MYSQL;?>
<img src="images/checkout_indicator2.png" />
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	if (get_magic_quotes_gpc()) {
		$_POST['cc_first_name'] = stripslashes($_POST['cc_first_name']);
		// Repeat for other variables that could be affected.
	}

	// Check for a first name:
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $_POST['cc_first_name'])) {
		$cc_first_name = $_POST['cc_first_name'];
		echo$cc_first_name;
	} else {
		$billing_errors['cc_first_name'] = 'Please enter your first name!';
	}

	// Check for a last name:
	if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $_POST['cc_last_name'])) {
		$cc_last_name  = $_POST['cc_last_name'];
	} else {
		$billing_errors['cc_last_name'] = 'Please enter your last name!';
	}
	
	// Check for a valid credit card number...
	// Strip out spaces or hyphens:
	$cc_number = str_replace(array(' ', '-'), '', $_POST['cc_number']);
	
	// Validate the card number against allowed types:
	if (!preg_match ('/^4[0-9]{12}(?:[0-9]{3})?$/', $cc_number) // Visa
	&& !preg_match ('/^5[1-5][0-9]{14}$/', $cc_number) // MasterCard
	&& !preg_match ('/^3[47][0-9]{13}$/', $cc_number) // American Express
	&& !preg_match ('/^6(?:011|5[0-9]{2})[0-9]{12}$/', $cc_number) // Discover
	) {
		$billing_errors['cc_number'] = 'Please enter your credit card number!';
	}
	
	// Check for an expiration date:
	if ( ($_POST['cc_exp_month'] < 1 || $_POST['cc_exp_month'] > 12)) {
		$billing_errors['cc_exp_month'] = 'Please enter your expiration month!';		
	}

	if ($_POST['cc_exp_year'] < date('Y')) {
		$billing_errors['cc_exp_year'] = 'Please enter your expiration year!';
	}
	
	// Check for a CVV:
	if (preg_match ('/^[0-9]{3,4}$/', $_POST['cc_cvv'])) {
		$cc_cvv = $_POST['cc_cvv'];
	} else {
		$billing_errors['cc_cvv'] = 'Please enter your CVV!';
	}
	
	// Check for a street address:
	if (preg_match ('/^[A-Z0-9 \',.#-]{2,160}$/i', $_POST['cc_address'])) {
		$cc_address  = $_POST['cc_address'];
	} else {
		$billing_errors['cc_address'] = 'Please enter your street address!';
	}
		
	// Check for a city:
	if (preg_match ('/^[A-Z \'.-]{2,60}$/i', $_POST['cc_city'])) {
		$cc_city = $_POST['cc_city'];
	} else {
		$billing_errors['cc_city'] = 'Please enter your city!';
	}
ns
	// Check for a state:
	if (preg_match ('/^[A-Z]{2}$/', $_POST['cc_state'])) {
		$cc_state = $_POST['cc_state'];
	} else {
		$billing_errors['cc_state'] = 'Please enter your state!';
	}

	// Check for a zip code:
	if (preg_match ('/^(\d{5}$)|(^\d{5}-\d{4})$/', $_POST['cc_zip'])) {
		$cc_zip = $_POST['cc_zip'];
	} else {
		$billing_errors['cc_zip'] = 'Please enter your zip code!';
	}
	
	if (empty($billing_errors)) { // If everything's OK...

		// Convert the expiration date to the right format:
		$cc_exp = sprintf('%02d%d', $_POST['cc_exp_month'], $_POST['cc_exp_year']);

//$location = 'https://' . BASE_URIc . 'billing.php';
				header("Location: $location");
				exit();

/*$t = "SELECT CONCAT('M','medicine.medicine_id') AS 'sku', 'cart.quantity', 'sales.product_type',CONCAT_WS(\"-\",'size.size','medicine.medicine_name'),'medicine.price','medicine.stock','sales.price' FROM carts,sales,medicine WHERE 'c.user_session_id' >'2'";*/
//$q = "SELECT CONCAT('M',medicine_id) AS 'sku', medicine_name, price,stock FROM medicine WHERE medicine_id = 1 ";//WHERE size_id ='5' 
/*$q = "SELECT 'carts.quantity','sales.product_type','sales.price' AS sales_price FROM carts LEFT OUTER JOIN sales ON 'sales.cart_id' = 'carts.id' WHERE 'carts.user_session_id' = '5' ";*/

//$r = "SELECT CONCAT('M', 'med.medicine_id') AS 'sku', 'c.quantity', CONCAT_WS('-','s.size','med.medicine_name'), 'med.price', 'med.stock', 'sales.product_type','sales.price' AS sale_price FROM carts AS c INNER JOIN medicine AS med ON 'c.medicine_id'='med.id' INNER JOIN sizes AS s ON 's.id'='med.size_id' LEFT OUTER JOIN sales ON ('sales.medicine_id'='med.id' AND ((NOW() BETWEEN 'sales.start_date' AND 'sales.end_date') OR NOW()>'sales.start_date') AND 'sales.end_date' = NULL) WHERE 'c.user_session_id' = '5' ";
/*$q = "SELECT CONCAT('M', medicine_id) AS 'sku', 'cart_quantity', CONCAT_WS('-', s_size, medicine_name), price, stock, product_type, Final_sale AS sale_price FROM bond WHERE id = 1";
//require '/Wamp64/www/medibond/mysqli.inc.php';
	
//AND ((NOW() BETWEEN 'sales.start_date' AND 'sales.end_date') OR (NOW() > 'sales.start_date' )
	/*if (mysqli_num_rows($r) > 0) { // Products to show!
	//include('./views/cart.html');
		echo "string";
} else { // Empty cart!
	include('./views/emptycart.html');
}*/
/*$r = @mysqli_query($dbc,$q);
if ($r) {
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo $row['sale_price'];
}

mysqli_free_result($r);
}else{
	echo "An error occurred";
	echo mysqli_error($dbc);
}
mysqli_close($dbc);
*/

/*if (mysqli_num_rows($r)>0) {
	echo "able";
}
else{
	echo "fail";
}
*/
//$t = "SELECT cart.quantity, sales.product_type, customer.name FROM cart, sales, customer WHERE cart.id = ''
?>