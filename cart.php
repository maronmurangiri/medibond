<?php


// Require the configuration before any PHP code:
require('./includes/config.inc.php');
require 'head.php';


if(isset($_SESSION)){
	$uid = $_SESSION['user_id'];

		}
		else{
			echo "<div style='color:pink; font-weight:bold;'>Please Login to order another medicine</div>";
		}


// Send the cookie:
setcookie('SESSION', $uid, time()+(60*60*24*30));

// Include the header file:
$page_title = 'Medicine - Your Shopping Cart';
//include('./includes/header.html');
//include 'mysql.inc.php';

// Require the database connection:
require(MYSQL);

// Need the utility functions:
include('./includes/product_functions.inc.php');


// If there's a SKU value in the URL, break it down into its parts:
if (isset($_GET['id'])) {
	$_SESSION['pid'] = $_GET['id'];

}
if(isset($_SESSION['pid'])){
	$pid = $_SESSION['pid'];
}
echo($pid);

if (isset($pid,$uid, $_GET['action']) && ($_GET['action'] === 'add')) { // Add a new product to the cart:
	$r = mysqli_query($dbc, "CALL add_to_cart('$uid', $pid, 1)");
	
	/*"SELECT id  FROM carts WHERE user_session_id=5 AND product_type=$type AND product_id=$pid";
	if (id > 0) {
		"UPDATE carts SET quantity=quantity+$qty, date_modified=NOW() WHERE id=cid";
	}
	else{
		"INSERT INTO carts (user_session_id, product_type, product_id, quantity) VALUES ($uid, $type, $pid, $qty)";
	}*/

	// For debugging purposes:
	 //if (!$r) echo mysqli_error($dbc);
		//$uid = 20;
		//echo($uid);   
} elseif (isset($uid, $pid, $_GET['action']) && ($_GET['action'] === 'remove')) { // Remove it from the cart.
	//echo "$type";
	//echo($uid);
	//echo($pid);

		$r = mysqli_query($dbc, "CALL remove_from_cart('$uid', $pid)");
		//$r = "DELETE FROM bond WHERE user_session_id=$uid AND product_type=$type AND medicine_id=$pid";


} elseif (isset($uid,$pid, $_GET['action'], $_GET['qty']) && ($_GET['action'] === 'move')) { // Move it to the cart.
	
	// Determine the quantity:
	$qty = (filter_var($_GET['qty'], FILTER_VALIDATE_INT, array('min_range' => 1)) !== false) ? $_GET['qty'] : 1;
	//echo $qty; echo($uid); echo($pid); echo($type);
	// Add it to the cart:
	
	$r = mysqli_query($dbc, "CALL add_to_cart('$uid',$pid, $qty)");
	
	// Remove it from the wish list:
	$r = mysqli_query($dbc, "CALL remove_from_wish_list('$uid',$pid)");

	// Add it to the cart:
	/*$r = "SELECT id AS cid FROM carts WHERE user_session_id=$uid AND product_type=$type AND product_id=$pid";
 		if ('cid' > 0){
			"UPDATE carts SET quantity=quantity+$qty, date_modified=NOW() WHERE id=cid";
 		}
		else {
			$r = "INSERT INTO carts (user_session_id, product_type, product_id, quantity) VALUES ($uid, $type, $pid, $qty)";
		
	
	// Remove it from the wish list:
			$r = "DELETE FROM wish_lists WHERE user_session_id=$uid AND product_type=$type AND product_id=$pid";
		}*/
//echo "Maron";
	}//echo($pid);
 elseif (isset($_POST['quantity'])) { // Update quantities in the cart.
	
	// Loop through each item:
	foreach ($_POST['quantity'] as $sku => $qty) {
		
		// Parse the SKU:
		list($type, $pid) = parse_sku($sku);
		
		if (isset($pid)) {

			// Determine the quantity:
			$qty = (filter_var($qty, FILTER_VALIDATE_INT, array('min_range' => 0)) !== false) ? $qty : 1;

			// Update the quantity in the cart:
			$r = mysqli_query($dbc, "CALL update_cart('$uid', $pid, $qty)");

		}
			
	} // End of FOREACH loop.
	
}// End of main IF.
	
	
// End of main IF. 
		
// Get the cart contents:
	/*$q = "SELECT CONCAT('H', medicine_id) AS 'sku', Cart_quantity, CONCAT_WS('-', s_size, medicine_name) AS name, price, stock, product_type, Final_sale AS sale_price FROM bond WHERE product_type = 'Human medicine' AND user_session_id = 1 UNION SELECT CONCAT('V', medicine_id) AS 'sku', Cart_quantity, CONCAT_WS('-', s_size, medicine_name) AS name, price, stock, product_type, Final_sale AS sale_price FROM bond WHERE product_type = 'veterinary medicine' AND user_session_id = 20";*/

/*INSERT INTO order_contents (order_id, product_type, product_id, quantity, price_per) SELECT oid, c.product_type, c.product_id, c.quantity, IFNULL(sales.price, med.price) FROM carts AS c INNER JOIN medicine AS med ON c.medicine_id=med.medicine_id LEFT OUTER JOIN sales ON (sales.medicine_id=med.sale_id AND sales.product_type='Human medicine' AND ((NOW() BETWEEN sales.start_date AND sales.end_date) OR (NOW() > sales.start_date AND sales.end_date IS NULL)) ) WHERE c.product_type="Human medicine" AND c.user_session_id=uid UNION SELECT oid, c.product_type, c.product_id, c.quantity, IFNULL(sales.price, sc.price) FROM carts AS c INNER JOIN medicine AS med ON c.medicine_id=med.medicine_id LEFT OUTER JOIN sales ON (sales.medicine_id=med.sale_id AND sales.product_type='veterinary medicine' AND ((NOW() BETWEEN sales.start_date AND sales.end_date) OR (NOW() > sales.start_date AND sales.end_date IS NULL)) ) WHERE c.product_type="veterinary medicine" AND c.user_session_id=uid;*/
//echo ($uid);echo ($uid);
//sales.price AS sale_price
//AND ((NOW() BETWEEN sales.start_date AND sales.end_date) OR (NOW() > sales.start_date AND sales.end_date IS NULL)))
	//INNER JOIN sizes AS s ON s.id=med.size_id LEFT OUTER JOIN sales ON (sales.id=med.sale_id
$q = "SELECT med.medicine_id,CONCAT('H',med.medicine_id) AS sku, c.quantity,c.user_session_id, med.medicine_name,med.price, med.stock FROM carts AS c INNER JOIN medicine AS med ON c.medicine_id=med.medicine_id  WHERE c.user_session_id=".$uid.";"; 
/* UNION SELECT CONCAT('V', med.medicine_id) AS sku, c.quantity,c.user_session_id,med.product_type, CONCAT_WS(\"-\",s.size,med.medicine_name) AS name,med.price, med.stock, sales.price AS sale_price FROM carts AS c INNER JOIN medicine AS med ON c.medicine_id=med.medicine_id INNER JOIN sizes AS s ON s.id=med.size_id LEFT OUTER JOIN sales ON (sales.id=med.sale_id  AND ((NOW() BETWEEN sales.start_date AND sales.end_date) OR (NOW() > sales.start_date AND sales.end_date IS NULL))) WHERE med.product_type='veterinary medicine' AND c.user_session_id= 2";*/

$r = @mysqli_query($dbc,$q);
if (mysqli_num_rows($r) > 0) {
 // Products to show!

	//echo "Success";
	include('./views/cart.html');
} else { // Empty cart!
	include('./views/emptycart.html');
}

// Finish the page:
//include('./includes/footer.html');
?>