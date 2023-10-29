<?php

// This script defines any functions required by the various forms.
// This script is created in Chapter 3.

// This function generates a form INPUT or TEXTAREA tag.
// It takes five arguments:
// - The name to be given to the element.
// - The type of element (text, password, textarea).
// - The label for the element
// - An array of errors.
// - An array of additional options.
function create_form_input($name, $type, $errors = array(), $values = 'POST', $options = array()) {
	
	// Assume no value already exists:
	$value = false;

	// Get the existing value, if it exists:
	if ($values === 'SESSION') {
		
		if (isset($_SESSION[$name])) $value = htmlspecialchars($_SESSION[$name], ENT_QUOTES, 'UTF-8');
		
	} elseif ($values === 'POST') {
		
		if (isset($_POST[$name])) $value = htmlspecialchars($_POST[$name], ENT_QUOTES, 'UTF-8');
		// Strip slashes if Magic Quotes is enabled:
		if ($value && get_magic_quotes_gpc()) $value = stripslashes($value);

	}

	// Conditional to determine what kind of element to create:
	if ( ($type === 'text') || ($type === 'password') ) { // Create text or password inputs.
		
		// Start creating the input:
		echo '<input type="' . $type . '" name="' . $name . '" id="' . $name . '"';

		// Add the value to the input:
		if ($value) echo ' value="' . $value . '"';

		// Check for any extras:
		if (!empty($options) && is_array($options)) {
			foreach ($options as $k => $v) {
				echo " $k=\"$v\"";
			}
		}

		// Check for an error:  v=WD1Z8_H4ts
		if (array_key_exists($name, $errors)) {
			echo 'class="error" /> <span class="error">' . $errors[$name] . '</span>';
		} else {
			echo ' />';		
		}
		
	} elseif ($type === 'select') { // Select menu.
		
		if (($name === 'state') || ($name === 'cc_state')) { // Create a list of states.
			
			$data = array('01' => 'Mombasa', '02' => 'Kwale', '03' => 'Kilifi', '04' => 'Tana River', '05' => 'Lamu', '06' => 'Taita Taveta', '07' => 'Garissa', '08' => 'Wajir', '09' => 'Mandera', '10' => 'Marsabit', '11' => 'Isiolo', '12' => 'Meru', '13' => 'Tharaka Nithi', '14' => 'Embu', '15' => 'Kitui', '16' => 'Machakos', '17' => 'Makueni', '18' => 'Nyandarua', '19' => 'Nyeri', '20' => 'Kirinyaga', '21' => "Murang'a", '22' => 'Kiambu', '23' => 'Turkana', '24' => 'West Pokot', '25' => 'Samburu', '26' => 'Trans nzoia', '27' => 'Uasin Gishu', '28' => 'Elgeyo Marakwet', '29' => 'Nandi', '30' => 'Baringo', '31' => 'Laikipia', '32' => 'Nakuru', '33' => 'Narok', '34' => 'Kajiado', '35' => 'kericho', '36' => 'Bomet', '37' => 'Kakamega', '38' => 'Vihiga', '39' => 'Bungoma', '40' => 'Busia', '41' => 'Siaya', '42' => 'Kisumu', '43' => 'Homa Bay', '44' => 'Migori', '45' => 'Kisii', '46' => 'Nyamira', '47' => 'Nairobi');
			
		} elseif ($name === 'cc_exp_month') { // Create a list of months.

			$data = array(1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',  'September', 'October', 'November', 'December');
			
		} elseif ($name === 'cc_exp_year') { // Create a list of years.
			
			$data = array();
			$start = date('Y'); // Start with current year.
			for ($i = $start; $i <= $start + 5; $i++) { // Add five more.
				$data[$i] = $i;
			}
			
		}elseif ($name === 'category') {
			$data =  array('V' => 'veterinary medicine', 'H' =>'Human medicine');
		} // End of $name IF-ELSEIF.
		
		// Start the tag:
		echo '<select name="' . $name  . '"';
	
		// Add the error class, if applicable:
		if (array_key_exists($name, $errors)) echo ' class="error"';

		// Close the tag:
		echo '>';		
	
		// Create each option:
		foreach ($data as $k => $v) {
			echo "<option value=\"$k\"";
			
			// Select the existing value:
			if ($value === $k) echo ' selected="selected"';
			
			echo ">$v</option>\n";
			
		} // End of FOREACH.
	
		// Complete the tag:
		echo '</select>';
		
		// Add an error, if one exists:
		if (array_key_exists($name, $errors)) {
			echo '<br /><span class="error">' . $errors[$name] . '</span>';
		}
		
	} elseif ($type === 'textarea') { // Create a TEXTAREA.

		// Display the error first: 
		if (array_key_exists($name, $errors)) echo ' <span class="error">' . $errors[$name] . '</span><br />';

		// Start creating the textarea:
		echo '<textarea name="' . $name . '" id="' . $name . '" rows="5" cols="75"';

		// Add the error class, if applicable:
		if (array_key_exists($name, $errors)) {
			echo ' class="error">';
		} else {
			echo '>';		
		}

		// Add the value to the textarea:
		if ($value) echo $value;

		// Complete the textarea:
		echo '</textarea>';

	} // End of primary IF-ELSEIF.

} // End of the create_form_input() function.

// Omit the closing PHP tag to avoid 'headers already sent' errors!