<?php
phpinfo();
echo "Maron is a male student";
require 'mysqli.inc.php';

$r = "INSERT INTO `sizes` VALUES('Half Pound')";

if (mysqli_affected_rows($r)==1) {
	echo "Table created";
}else{
echo "This a medicine delivery site";
}
?>