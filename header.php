<?php ob_start();
session_start();
	
	 // Check for a $page_title value:
	 if (!isset($page_title)) {
	 	 $page_title = 'User Registration';
	 }
	 ?>
	 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/ xhtml1-transitional.dtd">
	 <html xmlns="http://www.w3.org/1999/ xhtml" xml:lang="en" lang="en">
	 	 <head>
	 	 <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	 	 <title>
	 	 	<?php echo $page_title; ?>
	 	</title>
	 	 <style type="text/css"media="screen">
	 	 	@import "includes/layout.css";
		</style>
	 </head>
	 <body>
	 <div id="Header">User Registration</div>
	 	 <div id="Content">
	 