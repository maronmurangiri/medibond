<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
   
    <link rel="stylesheet" href="home.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="slider.js"></script>
    <script>
        function myFunction() {
                alert("Sign Up Success!\n You may now login");
            }
    </script>
   <style type="text/css">
       .error{
        color: purple;
        font-weight: bold;
        text-align: center;
       }
       
   </style>
</head>
<body>
    <?php 
  
  if ( isset($_GET['success']) && $_GET['success'] == 1 )
{
     echo "<body onload=\"myFunction()\">";

/*"<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Alert!</h4>
                Success alert preview. This alert is dismissable.
              </div>";*/
}
?>

    <div>
        <?php 
       
            require 'head.php';
        ?>
        <?php 
            if(isset($_GET['e'])){
                echo "<p class=\"error\">".$_GET['e']."</p>";
            }
        ?>
    </div>
    <div class="slider">
    	<?php 
    		require'slider.php';
    	?>
    

    </div>
    <div class="commit">
    	<h1>Commited to quality and efficiency</h1>
    	<p>
    		medibond.com is an online pharmacy powered by Kenya  Medical Supplies Authority Drugstore and retains a Verified Internet Pharmacy Practice Sites accreditation through the Kenya Pharmacy and poisonous board(KPPB®), proving our commitment to the highest quality medications and practices in the pharmaceutical arena.<br><br>


Our operations include protecting patient confidentiality for all personal medical information. Policies and procedures are actively examined to ensure the highest standards. We combine the expertise of our highly skilled pharmacists with automation systems to help streamline the workflow and reduce the risk of errors. We are the future of pharmaceuticals in Kenya!
    	</p><br>
    	<p>Follow us on our social media platforms</p>
    </div>
    <div class="follow">
    	<div class="twitter"><big><a href="#" style="color: #00acee;"><i class="fab fa-twitter-square"></i></a></big></div>
        <div class="facebook"><big><b><a href="#" style="color: #3b5998;"><i class="fab fa-facebook-square"></i></a></b></big></div>
        <div class="instagram"><big><b><a href="#" style="color: #C13584;"><i class="fab fa-instagram-square"></i></a></b></big></div>
        <div class="link"><big><b><a href="#" style="color: #0077b5;"><i class="fab fa-linkedin"></i></a></b></big></div>
        <div class="telegram"><big><b><a href="#" style="color: #0088cc;"><i class="fab fa-telegram"></i></a></b></big></div>

    </div>
    <div class="ship">
        <div class="lorry"><big><b><a href="#" style="color: #0088cc;"><i class="fas fa-truck-moving"></i></a></b></big></div>
        <div class="shipc">
            <div class="chep"><h3 class="chep">Cheaper and affordable shipping</h3></div>
            
        </div>
        <div class="enjoy">
            <div><h4>Enjoy reliable shipping from our door to your door.</h4></div>
            <div><p>We are licenced to ship across all parts of Kenya and East Africa in General.</p></div>
            <p>Medibond ships your order to wherever you are whenever you shop with us.  We bridge the gap between you and the pharmacy. </p>

        </div>

    </div>
    <div class="triangle-down"></div>
    <div class="work">
        <div class="how">How it works</div>
        <div class="m1"><i class="far fa-comment"></i></div>
        <div class="m1a">1</div>
        <div class="doctor"><i class="fas fa-user-md"></i></div>
        <div class="doctorn"><big>Doctor</big></div>
        <div class="doctorsend"><p>Send your patient's prescription via : </p><p>E-Scribe: Medibond</p><p>Call: +254-00-606-978</p></div>

        <div class="m2" ><i class="far fa-comment"></i></div>
        <div class="m2a">2</div>
        <div class="user1"><i class="fas fa-user-tie"></i><i class="fas fa-user-alt"></i></div>

        <div class="user2"><big>You</big></div>
        <div class="usersend"><p>Have your doctor send us your prescription : </p><p>Visit medibond.com</p><p>Create a profile and select your medications</p><p>Checkout and receive your prescriptions</p></div>
        <div class="mend">Medibond will do the rest</div>
        

    </div>
    <div class="oval"></div>
    <div>
        <div class="customer" >Customer Experience </div>
        <p class="deliver"><i class="fas fa-truck"></i></p>
        <p class="million1">10+ Million</p>
        <p class="c1">Orders Delivered</p>

        <p class="rate"><i class="fas fa-star"></i></p>
        <p class="star">4.7 Star</p>
        <p class="app">app rating</p>

        <p class="phone"><i class="fas fa-phone-square-alt"></i></p>
        <p class="hours">24 Hours</p>
        <p class="resp">Respondence</p></i></p>
    </div>
    <div class="medicine">
        <p>Medibond is the best <b>affordable</b> </br>and <b>efficient</b> online pharmacy.</p>
        <p>My medicines are delivered to me</br> in less than a week after placing the order.</p>
        <p style="color: blue;"><small>Catherine Silver</small></p>

    </div>
    <div class="thank">
        <p><b>Thanks Medibond</b></p>
        <p>I now receive my presicriptions at the comfort</br> of my house</p>
        <p>I found it hard to visit pharmacy every time I</br> was inneed of refilling my prescriptions, </br>but lucky enough medibond came to my rescue.</p>
        <p style="color: blue;"><small>Bahati Otieno</small></p>
    </div>
    <div class="easy">
        <p><b>Easy to use website</b></p>
        <p>Medibond has a simple and straight forward ordering flow.</p>
        <p>The product are also relatively cheaper than usual</p>
        <p style="color: blue;"><small>Mohammed Duale</small></p>
    </div>
    <div class="directO">
        <p class="direct">Director</p>
        <p class="img"><img class="img" src="drugs/maron.jpg" width="200" height="200"></p>
        <p class="directordis">On behalf of medibond management, and the entire fratenity, <br>I take this opportunity to welcome you to this online pharmacy. <br>This platform is fully equipped with both original and generic <br>medicines manufactured in various part of the world. <br>The platform is easy to use and navigate along. <br>We also sell medicine at an affordable price <br>and cheaper shipping cost.<br> Medibond has highly trained and experienced pharmacist<br> who ensures that the medicines have been administerd in the right way</p>
    
        <div>
            <p class="found">MARON MURANGIRI </br>Founder and senior partner</br> of Maron's foundation. </p>
        </div>
    </div>
  </body>
</html>
