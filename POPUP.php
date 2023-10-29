<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  //margin-top: 400px;
 // width: 300px;
}

/* The actual popup */
.popup .popuptext {
  visibility: hidden;
  width: 500px;
  //height: 300px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
 // bottom: 155%;
  left: 50%;
  margin-left: -170px;
  margin-top: 200px;
  top: -50px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}
.popuptext{
    margin-top: 500px;
    padding-top: 100px;
}

/* Toggle this class - hide and show the popup */
.popup .show {
  visibility: visible;
  //-webkit-animation: fadeIn 1s;
  //animation: fadeIn 1s;
}
.inf{
  margin-left: 30px;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
</style>
</head>
<body style="text-align:center">

<h2>popup</h2>

<div class="popup" onclick="myFunction()"><span class="inf">Click me to toggle the popup!</span>
  <span class="popuptext" id="myPopup"><?php include'login.php';?></span>
</div>

<script>
// When the user clicks on div, open the popup
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
</script>

</body>
</html>
