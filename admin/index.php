<?php

// This is the adminstrative home page.
// This script is created in Chapter 11.

// Require the configuration before any PHP code as configuration controls error reporting.
require('../includes/config.inc.php');

// Set the page title and include the header:
$page_title = 'Medibond - Administration';
include('includes/header.php');
//include('../head.php');
// The header file begins the session.
?>


 <link rel="stylesheet" href="../home.css">
    

 
      <div class="topnav">
       <b class="active"> Medibond</b>


       echo ' <a href="view_customers.php">Customers</a>
             <a href="view_orders.php">Orders</a></li>
            <a href="add_inventory.php">add inventory</a>
            <a href="add_other_products.php">Add New Product</a>
             
     ';
    
     }
     ?>

   </div>
    
    
</style>
<div>
    <div style="color:orange;text-align:center;"><h2>Medibond Administration</h2></div>
    <div ><h4>Welcome to the administration page of Medibond.</br>This is the page to be used to add new drugs to the database, add inventory to restock the products, view the orders made to facilitate order delivery and viewing of customers with corresponding editting functionalities</h4></div>
</div>

<div class="content">
      <div class="content1">Take prescription for your health safety</div>
       <div class="search-box">
        <input style="background-color: #ffffff;" type="text" aria-label="Search through site content" autocomplete="off" placeholder="Search for a product..." />
        <div class="result"> </div>
    </div>
</div>

   <div class="slider">
    	<?php 
    		require'../slider.php';
    	?>
    


    </div>
<?php include('./includes/footer.html'); ?>