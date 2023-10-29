<?php ob_start();
session_start();

// Check for a $page_title value:
   if (!isset($page_title)) {
     $page_title = 'User Registration';
   }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="home.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="slider.js"></script>
    
 <title>
      <?php echo $page_title; ?>
    </title>
     <style type="text/css"media="screen">
      @import "includes/layout.css";
    </style>
   </head>
    <style>
    body{
        font-family: Arail, sans-serif;
        background-color: #eeeeee;
    }
    /* Formatting search box */
    .search-box{
        width: 600px;
        position: relative;
        display: inline-block;
        font-size: 14px;
        background-color: red;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
        margin-right: 20px;
        background-color: red;

    }
    .result{
        position: absolute;        
       // z-index: 999;
        top: 100%;
        left: 0;
       // background-color: #f5c4cf;
         z-index: 9;
        margin: 20px;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
         //background-color: #f5c4cf;
         //position: relative;
         z-index: 10;

    }
    /* Formatting result items */
    .result p{
    	//position: relati;
        margin: 0;
        padding: 7px 10px;
       // border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
        width: 100%;
        // background-color: #f5c4cf;
         //z-index: 100;
          z-index: 9;
        //margin: 20px;
    }
    .result p:hover{
        background: #f2f2f2;
    }
    .down{
  margin-top: 50px;
}
  
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
  </head>
  <body>
   <!-- <nav>
      <div class="logo">Brand</div>
      <input type="checkbox" id="click">
      <label for="click" class="menu-btn">
        <i class="fas fa-bars"></i>
      </label>
      <ul>
        <li><a class="active" href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="register.php">Sign Up</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>-->