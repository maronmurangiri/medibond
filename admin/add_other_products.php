<?php
ob_start();
session_start();
// This file allows the administrator to add a non-coffee product.
// This script is created in Chapter 11.

// Require the configuration before any PHP code as configuration controls error reporting.
require('../includes/config.inc.php');

// Set the page title and include the header:
$page_title = 'Add a medicine';
include('./includes/header.css');
include('includes/header.php');
// The header file begins the session.

// Require the database connection:
require(MYSQL);

// For storing errors:
$add_product_errors = array();

// Check for a form submission:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {	

	// Check for a category:
	if (!isset($_POST['category']) || !filter_var($_POST['category'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
		$add_product_errors['category'] = 'Please select a category!';
	}

	// Check for a price:
	if (empty($_POST['price']) || !filter_var($_POST['price'], FILTER_VALIDATE_FLOAT) || ($_POST['price'] <= 0)) {
		$add_product_errors['price'] = 'Please enter a valid price!';
	}

	// Check for a stock:
	if (empty($_POST['stock']) || !filter_var($_POST['stock'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
		$add_product_errors['stock'] = 'Please enter the quantity in stock!';
	}
	if (empty($_POST['capacity'])) {
		$add_product_errors['stock'] = 'Please enter the dosage capacity';
	}

	// Check for a name:
	if (empty($_POST['name'])) {
		$add_product_errors['name'] = 'Please enter the name!';
	}

	// Check for a description:
	if (empty($_POST['overview'])) {
		$add_product_errors['overview'] = 'Please enter the overview!';
	}
	if (empty($_POST['precautions'])) {
		$add_product_errors['precautions'] = 'Please enter the precautions!';
	}
	if (empty($_POST['warnings'])) {
		$add_product_errors['warnings'] = 'Please enter the warnings!';
	}
	if (empty($_POST['side_effects'])) {
		$add_product_errors['side_effects'] = 'Please enter the side effects!';
	}
	if (empty($_POST['interactions'])) {
		$add_product_errors['interactions'] = 'Please enter the interactions!';
	}

	// Check for an image:
	if (is_uploaded_file($_FILES['image']['tmp_name']) && ($_FILES['image']['error'] === UPLOAD_ERR_OK)) {
		
		$file = $_FILES['image'];
		
		$size = ROUND($file['size']/1024);

		// Validate the file size:
		if ($size > 20000) {
			$add_product_errors['image'] = 'The uploaded file was too large.';
		} 

		// Validate the file type...

		// Allowed types:
		$allowed_mime = array ('image/gif', 'image/pjpeg', 'image/webp','image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');
		$allowed_extensions = array ('.jpg', '.gif', '.png', 'jpeg','.webp');

		// Check the file:
		$fileinfo = finfo_open(FILEINFO_MIME_TYPE);
		$file_type = finfo_file($fileinfo, $file['tmp_name']);
		finfo_close($fileinfo);
		$file_ext = substr($file['name'], -4);
		if ( !in_array($file_type, $allowed_mime) || !in_array($file_ext, $allowed_extensions) ) {
			$add_product_errors['image'] = 'The uploaded file was not of the proper type.';
		} 

		// Move the file over, if no problems:
		if (!array_key_exists('image', $add_product_errors)) {

			// Create a new name for the file:
			$new_name = sha1($file['name'] . uniqid('',true));

			// Add the extension:
			$new_name .= ((substr($file_ext, 0, 1) != '.') ? ".{$file_ext}" : $file_ext);

			// Move the file to its proper folder but add _tmp, just in case:
			$dest =  "../products/$new_name";
			
			if (move_uploaded_file($file['tmp_name'], $dest)) {
				
				// Store the data in the session for later use:
				$_SESSION['image']['new_name'] = $new_name;
				$_SESSION['image']['file_name'] = $file['name'];
				
				// Print a message:
				echo '<h4>The file has been uploaded!</h4>';
				
			} else {
				trigger_error('The file could not be moved.');
				unlink ($file['tmp_name']);				
			}

		} // End of array_key_exists() IF.
		
	} elseif (!isset($_SESSION['image'])) { // No current or previous uploaded file.
		switch ($_FILES['image']['error']) {
			case 1:
			case 2:
				$add_product_errors['image'] = 'The uploaded file was too large.';
				break;
			case 3:
				$add_product_errors['image'] = 'The file was only partially uploaded.';
				break;
			case 6:
			case 7:
			case 8:
				$add_product_errors['image'] = 'The file could not be uploaded due to a system error.';
				break;
			case 4:
			default: 
				$add_product_errors['image'] = 'No file was uploaded.';
				break;
		} // End of SWITCH.

	} // End of $_FILES IF-ELSEIF-ELSE.
	
	if (empty($add_product_errors)) { // If everything's OK.

		// Add the product to the database:
		//$q = 'INSERT INTO medicine (product_id, medicine_name, overview,precautions,warning,side_effects, interactions, image, price, stock) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

		// Prepare the statement:
		//$stmt = mysqli_prepare($dbc, $q);
		//if($stmt)echo mysqli_stmt_error($stmt);

		// For debugging purposes:
		// if (!$stmt) echo mysqli_stmt_error($stmt);

		// Bind the variables:
//mysqli_stmt_bind_param($stmt, 'isssssssii', 1, 'name', 'name', 'name', 'name', 'name', 'name', $_SESSION['image']['new_name'], 200, 10);
		$name = strip_tags($_POST['name']);
		$over = strip_tags($_POST['overview']);
		$prec = strip_tags($_POST['precautions']);
		$warn = strip_tags($_POST['warnings']);
		$side = strip_tags($_POST['side_effects']);
		$inte = strip_tags($_POST['interactions']);
		$id = $_POST['category'];
		$stock = $_POST['stock'];
		$image = $_SESSION['image']['new_name'];
		
		
			$price = $_POST['price']*100;
			//echo($image);

		//mysqli_stmt_bind_param($stmt, 'isssssssii', $id, $name, $over, $prec, $warn, $side, $inte, $image, $price, $stock);
		//echo($_POST['category']); 
		// Make the extra variable associations:
		
		// Execute the query:
		//mysqli_stmt_execute($stmt);
				//echo $inte;
			echo($price);
			$q = 'INSERT INTO medicine (product_id,capacity,medicine_name,overview,precautions,warning,side_effects,interactions,image,price, stock,nature_id) VALUES ('.$id.',"'.$_POST['capacity'].'","'.$_POST['name'].'","'.$over.'","'.$prec.'","'.$warn.'","'.$side.'","'.$inte.'","'.$image.'",'.$price.','.$stock.','.$id.');';
			//$q = 'INSERT INTO medicine (product_id, medicine_name, overview,precautions,warning,side_effects, interactions, image, price, stock) VALUES (2,"stock", "stock", "stock", "stock", "stock", "stock", "fa330f27ad523dd8dde5fa81f3eb66c01f178325.jpg", 10, 20)';
		
		//if (mysqli_stmt_affected_rows($stmt) === 1) { // If it ran OK.
			if(mysqli_query($dbc,$q)){
			// Print a message:
			echo '<h4>The product has been added!</h4>';

			// Clear $_POST:
			$_POST = array();
			
			// Clear $_FILES:
			$_FILES = array();
			
			// Clear $file and $_SESSION['image']:
			unset($file, $_SESSION['image']);
					
		} else { // If it did not run OK.
			$failure = "Unable to INSERT into DB: " .mysqli_error($dbc);
			//trigger_error('The product could not be added due to a system error. We apologize for any inconvenience.');
			//unlink ($dest);
			echo($failure);
		}
				
	} // End of $errors IF.
	
} else { // Clear out the session on a GET request:
	unset($_SESSION['image']);	
} // End of the submission IF.

// Need the form functions script, which defines create_form_input():
require('../includes/form_functions.inc.php');
?><h3>Add Stocked medicine Product</h3>

<form enctype="multipart/form-data" action="add_other_products.php" method="post" accept-charset="utf-8">

	<input type="hidden" name="MAX_FILE_SIZE" value="524288" />
	
	<fieldset><legend>Fill out the form to add a stocked medicine product to the catalog. All fields are required.</legend>
		
	<div class="field"><label for="category"><strong>Category</strong></label><br /><select name="category"<?php if (array_key_exists('category', $add_product_errors)) echo ' class="error"'; ?>>
		<option>Select One</option>
		<?php // Retrieve all the categories and add to the pull-down menu:
		$q = 'SELECT nature_id, type FROM nature ORDER BY type ASC';		
		$r = mysqli_query($dbc, $q);
			while ($row = mysqli_fetch_array ($r, MYSQLI_NUM)) {
				echo "<option value=\"$row[0]\"";
				// Check for stickyness:
				if (isset($_POST['category']) && ($_POST['category'] == $row[0]) ) echo ' selected="selected"';
				echo '>' . htmlspecialchars($row[1]) . '</option>';
			}
		?>
		</select><?php if (array_key_exists('category', $add_product_errors)) echo ' <span class="error">' . $add_product_errors['category'] . '</span>'; ?></div>
	
		<div class="field"><label for="name"><strong>Name</strong></label><br /><?php create_form_input('name', 'text', $add_product_errors); ?></div>

		<div class="field"><label for="price"><strong>Price</strong></label><br /><?php create_form_input('price', 'text', $add_product_errors); ?> <small>Without the dollar sign.</small></div>

		<div class="field"><label for="stock"><strong>Initial Quantity in Stock</strong></label><br /><?php create_form_input('stock', 'text', $add_product_errors); ?></div>
		<div class="field"><label for="capacity"><strong>Dosage</strong></label><br /><?php create_form_input('capacity', 'text', $add_product_errors); ?></div>
		
		<div class="field"><label for="overview"><strong>Overview</strong></label><br /><?php create_form_input('overview', 'textarea', $add_product_errors); ?></div>

		<div class="field"><label for="precautions"><strong>Precautions</strong></label><br /><?php create_form_input('precautions', 'textarea', $add_product_errors); ?></div>

		<div class="field"><label for="warnings"><strong>Warnings</strong></label><br /><?php create_form_input('warnings', 'textarea', $add_product_errors); ?></div>

		<div class="field"><label for="side effects"><strong>Side effects</strong></label><br /><?php create_form_input('side_effects', 'textarea', $add_product_errors); ?></div>

		<div class="field"><label for="interactions"><strong>Interactions</strong></label><br /><?php create_form_input('interactions', 'textarea', $add_product_errors); ?></div>





		<div class="field"><label for="image"><strong>Image</strong></label><br /><?php

		// Check for an error:
		if (array_key_exists('image', $add_product_errors)) {
			
			echo '<span class="error">' . $add_product_errors['image'] . '</span><br /><input type="file" name="image" class="error" />';
	
		} else { // No error.

			echo '<input type="file" name="image" />';

			// If the file exists (from a previous form submission but there were other errors),
			// store the file info in a session and note its existence:		
			if (isset($_SESSION['image'])) {
				echo "<br />Currently '{$_SESSION['image']['file_name']}'";
			}

		} // end of errors IF-ELSE.
		?></div>

	<br clear="all" />
	
	<div class="field"><input type="submit" value="Add This Product" class="button" /></div>
	
	</fieldset>

</form> 

<?php // Include the HTML footer:
include('./includes/footer.html');
?>