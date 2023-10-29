<?php


function get_just_price($price, $sale_price) {
	
	// Return the sale price, when appropriate:
	if ((0 < $sale_price) && ($sale_price < $price)) {
		return number_format($sale_price/100, 2);
	} else {
		return number_format($price/100, 2);
	}
	
} // End of get_just_price() fucntion.



// Function for parsing a SKU.
// Takes one argument: the SKU (such as C390 or G28).
// Returns an array.
function parse_sku($sku) {
	
	// Grab the first character:
	$type_abbr = substr($sku, 0, 1);
	
	// Grab the remaining characters:
	$pid = substr($sku, 1);	
	
	// Validate the type:
	if ($type_abbr === 'H') {
		$type = 'Human medicine';
	} 
	elseif ($type_abbr === 'V') {
		$type = 'veterinary medicine';
	}
	else {
		$type = NULL;
	}
	
	// Validate the product ID:
	$pid = (filter_var($pid, FILTER_VALIDATE_INT, array('min_range' => 1))) ? $pid : NULL;
	
	// Return the values:
	return array($type, $pid);

} // End of parse_sku() function.

// Function for calculating the shipping and handling.
// Takes one argument: the current order total.
// Returns a float.
function get_shipping($total = 0) {
	
	// Set the base handling charges:
	$shipping = 3;
	
	// Rate is based upon the total:
	if ($total < 10) {
		$rate = .25;
	} elseif ($total < 20) {
		$rate = .20;
	} elseif ($total < 50) {
		$rate = .18;
	} elseif ($total < 100) {
		$rate = .16;
	} else {
		$rate = .15;
	}
	
	// Calculate the shipping total:
	$shipping = $shipping + ($total * $rate);

	// Return the shipping total:
	return $shipping;
	
} // End of get_shipping() function.
 