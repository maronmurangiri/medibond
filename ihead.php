<?php ob_start();
session_start();

// Check for a $page_title value:
   if (!isset($page_title)) {
     $page_title = 'User Registration';
   }
?>
<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
   <!--------- <title>Responsive Navigation Menu</title>------>
    <link rel="stylesheet" href="home.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    	//position: relative;
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
        position: relative;
  //top: 0;
  //left: 0;
  //width: 100%;
  //height: 100%;
  
    }
    .result p:hover{
        background: #f2f2f2;
    }
    .down{
  margin-top: 50px;
}
nav ul li button{
  color: #f2f2f2;
  text-decoration: none;
  font-size: 18px;
  font-weight: 500;
  padding: 8px 15px;
  border-radius: 5px;
  letter-spacing: 1px;
  transition: all 0.3s ease;
  background-color: black;
  //display: none;
}
nav ul li button.active,
nav ul li button:hover{
   color: #111;
  background: #fff;
}
.button {
    border: none;
    background: none;
    cursor: pointer;
    //margin: 0;
    //padding: 0;
    padding-top: 2px;
    //height: 35px;
    text-align: center;
}
.nav{
  margin-top: -28px;

}



body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: right;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
  float: left;
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
<link rel="stylesheet" type="text/css" href="index1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>`
  </head>
  <body class="body">

    <?php
    //include'register_popup.php';

     //include'home_login_popup.php';

     ?>
     <div class="topnav">
        <a class="active" href="#home">Home</a>
        <a href="#news">Cart</a>
        <a href="#contact">Message Center</a>
        <a href="#about">Log out</a>
    </div>
    
   
   
    <div class="content">
      <div class="content1">Take prescription for your health safety</div>
      <div class="search-box">
        <input style="background-color: #ffffff;" type="text" aria-label="Search through site content" autocomplete="off" placeholder="Search for a product..." />
        <div class="result"> </div>
      </div>
    </div>