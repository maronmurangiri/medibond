<?php
 $page_title = 'view Customer\'s information';
	 include ('includes/header.php');
	 echo '<h1>View Customer\'s information</h1>';

if ( (isset($_GET['cid'])) && (is_numeric($_GET['cid'])) ) { // From view_users.php
	 	 $id = $_GET['cid'];
	 } else { // No valid ID, kill the script.
	 	 echo '<p class="error">This page has been accessed in error.</p>';
	 	
	 	 include ('includes/footer.html');
	 	 exit();
	 }

	 require('../includes/config.inc.php');
	 require (MYSQL);
	 echo($id);
	 $q = "SELECT last_name, first_name,email,CONCAT_WS(\"   \", address1, address2, city, state, zip) AS address, phone,
DATE_FORMAT(date_created, '%M %d, %Y') AS cd, id FROM customers WHERE id=$id LIMIT 1";
$r = @mysqli_query ($dbc, $q);
	 //$q = "SELECT * FROM  customers WHERE id = $id LIMIT 1";
	 echo '<table align="center" cellspacing="0"
cellpadding="5" width="99%">
	 <tr>
	 	 <td align="left"><b>Edit</b></td>
	 	 <td align="left"><b>Delete</b></td>
	 	 <td align="left"><b>Last Name</b></td>
	 	 <td align="left"><b>First Name</b></td>
	 	 <td align="left"><b>Email</b></td>
	 	 <td align="left"><b>Address</b></td>
	 	 <td align="left"><b>Phone number</b></td>
	 	 <td align="left"><b> Purchase Date</b></td>
	 </tr>
	 ';
		 // Fetch and print all the records....
	 $bg = '#eeeeee';
	 while ($row = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
	 	 $bg = ($bg=='#eeeeee' ? '#ffffff' :
'#eeeeee');
	 	 	 echo '<tr bgcolor="' . $bg . '">
	 	 	 		<td align="left"><a href="edit_customer.php?id=' . $row['id'] .'">Edit</a></td>
	 	 	 <td align="left"><a href="delete_customer.php?id=' . $row['id'] .'">Delete</a></td>
	 	 	 <td align="left">' . $row['last_name'] . '</td>
	 	 	 <td align="left">' . $row['first_name'] . '</td>
	 	 	 <td align="left">' . $row['email'] . '</td>
	 	 	 <td align="left">' . $row['address'] . '</td>
	 	 	 <td align="left">' . $row['phone'] . '</td>
	 	 	 <td align="left">' . $row['cd'] .'</td>
	 	 </tr>
	 	 ';
	 } // End of WHILE loop.
	
	 echo '</table>';
	 mysqli_free_result ($r);
	 mysqli_close($dbc);
	