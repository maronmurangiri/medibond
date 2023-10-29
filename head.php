<?php
 ob_start();
session_start();

// Check for a $page_title value:
   if (!isset($page_title)) {
     $page_title = 'Medibond';
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
/*a button{
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
}*/

/*#button {
    border: none;
    background: none;
    cursor: pointer;
    margin: 0;
    padding: 0;
    padding-top: 2px;
    //height: 35px;
    text-align: center;
}*/
/*.nav{
  margin-top: -28px;

}*/
.cart{
  margin-left: -100px;
}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
  padding-top: 10px;
  padding-bottom: 10px;
  //position: relative;
  //z-index: 1;
}

.topnav a {
  float: right;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}
.topnav button{
  float: right;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  //margin-top:100px;
  background: none;
  border:none;
  
}

.topnav a:hover {
  background-color: #ffffff;
  color: black;
}
.topnav button:hover{
  background-color: #ffffff;
  color: black;
}

.topnav b.active {
  background-color: #333;
  color: white;
  float: left;
  //background-color: none;
  text-align: center;
}
.loggin{
  float: left;
  //margin-left: px;
  //margin-top: 33px; 
}
.content{
  margin-top: 120px;
}

.slider{
  margin-top: -200px;
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

    <?php
    //include'register_popup.php';

    //include'home_login_popup.php';

     ?>
      <div class="topnav">
       <b class="active"> Medibond</b>

        <?php 
            if(isset($_SESSION['user_id'])){
                echo'<a href="logsout.php">Logout</a>
                 <a href="#contact">Message Center</a>
                  <a href="change_password.php"title="Change Your Password">Change Password</a><br />
                 <a href="">Cart</a>
                </div>';
              if ($_SESSION['user_level'] == 1) {
                    echo '<li><a href="admin" title="View All Users">Admin Panel</a></li>
                       
                        ';
                }
            }else { //    Not logged in.
              include'register_popup.php';

          include'home_login_popup.php';
          

       echo '<button id="buttton" class="open-button" onclick="openhForm()">Sign Up</button>
            <button id="button" class="open-button" onclick="openForm()">Login</button>
            <a href="forgot_password.php"title="Password Retrieval">Retrieve Password</a><br /> 
            <a href="index.php">Home</a>
            
     ';
    
     }
     ?>

   </div>
    
    
    
      <!--<input type="checkbox" id="click">
      <label for="click" class="menu-btn">
        <i class="fas fa-bars"></i>
      </label>-->
    

    <div class="content">
      <div class="content1">Take prescription for your health safety</div>
       <div class="search-box">
        <input style="background-color: #ffffff;" type="text" aria-label="Search through site content" autocomplete="off" placeholder="Search for a product..." />
        <div class="result"> </div>
    </div>
    </div>