<style>
     a{
       // border: solid 1px #ff0000;
        //background:#33ff33; 
        font-family: arial, sans-serif;
        color:blue; 
        font-size: 14px; 
        border-radius: 5px;
        text-decoration:none;
    }
    a:hover{
        background:orange; 
    }
</style>
<?php 

 $page_title = 'View the Current Customers';
 include ('includes/header.php');
	 echo '<h1 style="align:center;">Medibond Customers</h1>';
	
	require('../includes/config.inc.php');
	 require (MYSQL);
	
 // Number of records to show per page:
	 $display = 10;
	
	 // Determine how many pages there are...
	 if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	 	 $pages = $_GET['p'];
	 } else { // Need to determine.
	 	 // Count the number of records:
	 	 $q = "SELECT COUNT(id) FROM customers";
	 	 $r = @mysqli_query ($dbc, $q);
	 	 $row = @mysqli_fetch_array ($r,MYSQLI_NUM);
	 	 $records = $row[0];
	 	 // Calculate the number of pages...
	 	 if ($records > $display) { // More than 1 page.
	 	 	 $pages = ceil ($records/$display);
	 	 } else {
	 	 	 $pages = 1;
	 	 }
	 } // End of p IF.
	
	 // Determine where in the database to start returning results...
	 if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	 		$start = $_GET['s'];
	 		
	} else {
	 	 $start = 0;
	 	 
	 }


 // Determine the sort...
 // Default is by registration date.
 $sort = (isset($_GET['sort'])) ?
$_GET['sort'] : 'cd';
	
	 // Determine the sorting order:
 switch ($sort) {
 case 'ln':
 $order_by = 'last_name ASC';
 break;
 case 'fn':
 $order_by = 'first_name ASC';
 break;
 case 'cd':
 $order_by = 'date_created
 DESC';
 break;
 default:
 $order_by = 'date_created
 ';
 $sort = 'cd';
 break;
 }
	 	
	 	 
	 	
	 // Define the query:
 $q = "SELECT last_name, first_name,email,CONCAT_WS(\"   \", address1, address2, city, state, zip) AS address, phone,
DATE_FORMAT(date_created, '%M %d, %Y') AS cd, id FROM customers ORDER BY $order_by LIMIT $start, $display";
	 $r = @mysqli_query ($dbc, $q); // Run the query.
	
	 // Table header:
	 echo '<table align="center" cellspacing="0"
cellpadding="5" width="99%">
	 <tr>
	 	 <td align="left" style="color:blue;"><b>Edit</b></td>
	 	 <td align="left" style="color:blue;"><b>Delete</b></td>
	 	 <td align="left"><b><a href="view_customers.php?sort=ln">Last Name</a></b></td>
	 	 <td align="left"style="color:red;"><b><a href="view_customers.php?sort=fn">First Name</a></b></td>
	 	 <td align="left" style="color:blue;"><b>Email</b></td>
	 	 <td align="left" style="color:blue;"><b>Address</b></td>
	 	 <td align="left" style="color:blue;"><b>Phone number</b></td>
	 	 <td align="left" style="color:blue; font-weight:900;"><b><a href="view_customers.php?sort=cd"> Purchase Date </a></b></td>
	 </tr>
	 ';
		 // Fetch and print all the records....
	 $bg = '#eeeeee';
	 while ($row = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
	 	 $bg = ($bg=='#eeeeee' ? '#ffffff' :
'#eeeeee');
	 	 	 echo '<tr bgcolor="' . $bg . '">
	 	 	 		<td align="left"><a href="edit_customer.php?id=' . $row['id'] .'">Edit</a></td>
	 	 	 <td align="left"><a href="delete_customer.php?id=' . $row['id'] .'" class="del">Delete</a></td>
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
	
	 // Make the links to other pages, if necessary.
	 if ($pages > 1) {
	 	
	 	 echo '<br /><p>';
	 	 $current_page = ($start/$display) + 1;
	 	
	 	 // If it's not the first page, make a Previous button:
	 	 if ($current_page != 1) {
	 	 	echo '<a href="view_customers.php?s=' . ($start - $display) .'&p=' . $pages . '&sort=' .$sort .'>Previous</a> ';
	 	 }
	 	
	 	 // Make all the numbered pages:
	 	 for ($i = 1; $i <= $pages; $i++) {
	 	 	 if ($i != $current_page) {
				echo '<a href="view_customers.php?s=' . (($display * ($i -1))) . '&p=' . $pages .'&sort=' . $sort . '">' .$i . '</a> ';
	 	 	 } else {
	 	 	 	 echo $i . ' ';
	 	 	 }
	 	 } // End of FOR loop.
	 	
	 	 // If it's not the last page, make a Next button:
	 	 if ($current_page != $pages) {echo '<a href="view_customers.php?s=' . ($start + $display) .'&p=' . $pages . '&sort=' .$sort . '">Next</a>';
	 	 }
	 	
	 	 echo '</p>'; // Close the paragraph.
	 	
	 } // End of links section.
	 	
	 include ('includes/footer.html');
	 


/*
	 $page_title = 'View the Current Users';
	 include ('includes/header.html');
	
	 // Page header:
	 echo '<h1>Customers</h1>';
	
	 require('../includes/config.inc.php');
	 require (MYSQL);
	 // Connect to the db.
	 	 	
	 // Make the query:
	 $q = "SELECT CONCAT(last_name, ', ',first_name) AS name, email, CONCAT_WS(\" \", address1, address2, city, state, zip) AS address, phone, date_created FROM Customers ORDER BY id DESC";
	 $r = @mysqli_query ($dbc, $q); // Runthe query.
	 // Count the number of returned rows:
 $num = mysqli_num_rows($r);
	
 if ($num > 0) { // If it ran OK,display the records.
	 	 // Print how many users there are:
 echo "<p>There are currently $num Customers.</p>\n";
	
	 	 // Table header.
	 	 echo '<table align="center" cellspacing="3" cellpadding="3"width="75%">
			 	 <tr>
			 	 <td align="left"><b>Name</b></td>
			 	 <td align="left"><b>Email</b></td>
			 	 <td align="right"><b>Address</b></td>
			 	 <td align="right"><b>Phone number</b></td>
			 	 <td align="center"><b>Purchase Date</b></td>
			 	 </tr>
	 ';
	 	
	 	 // Fetch and print all the records:
	 	 while ($row = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
	 	 	 echo '<tr>
	 	 	 		<td align="left">' .$row['name'] . '</td><td align=	"left">' . $row['email'] . '</td><td align="right">' .$row['address'] . '</td><td align=	"center">' . $row['phone'] . '</td><td align=	"right">' . $row['date_created'] . '</td>
	 	 	 		</tr>';
	 	 }

	 echo '</table>'; // Close the table.
 	
	 	 mysqli_free_result ($r); // Free up the resources.	
	

	 } else { // If no records were returned.
	
 echo '<p class="error">There are currently no registered users.</p>';


	
	 }

	 mysqli_close($dbc); // Close the database connection.
	
	 include ('includes/footer.html');*/?>