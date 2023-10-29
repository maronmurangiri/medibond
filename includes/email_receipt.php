<?php
										
//require "mysqli.inc.php";
// This script sends a receipt out in HTML format.
// This script is created in Chapter 10.

// Create the message body in two formats:
$q = "SELECT med.medicine_name,oc.quantity FROM medicine as med INNER JOIN order_contents as oc ON med.medicine_id=oc.product_id WHERE order_id=".$_SESSION['order_id'].";";
$r = mysqli_query($dbc,$q) or trigger_error("Query: $q \n<br />MySQL Error: " .mysqli_error($dbc));
	 	 			;
if(mysqli_num_rows($r)>0){
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	
	$s = "INSERT INTO prescription(Prescription_drug_inf,refill_inf,prescriber,action,user_id) VALUES('".$row['medicine_name']."','Kindly Update..','Kindly Update..',".$row['quantity'].",".$_SESSION['user_id'].")";
	$d = mysqli_query($dbc,$s) or trigger_error("Query: $s\n<br />MySQL Error: " .mysqli_error($dbc));
	 	 			;
}
}else{echo "fail";}
 /* HTML body:,
}
$body_html .= '</table></body></html>';


// Uses Composer to autoload the Zend Framework files:
require('includes/vendor/autoload.php');
//require('includes/vendor/zend-mail');
// Create a new mail:
use Zend\Mail\message;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Mime\Mime;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

// Create the parts:
$html = new MimePart($body_html);
$html->type = "text/html";

$plain = new MimePart($body_plain);
$plain->type = "text/plain";

// Create the message:
$body = new MimeMessage();
$body->setParts(array($plain, $html));
 
// Establish the email parameters:
$mail = new Mail\Message();
$mail->setFrom('admin@example.com');
$mail->addTo($_SESSION['email']);
$mail->setSubject("Order #{$_SESSION['order_id']} at the Coffee Site");
$mail->setEncoding("UTF-8");
$mail->setBody($body);
$mail->getHeaders()->get('content-type')->setType('multipart/alternative');
echo $body_html;
echo $body_plain; die();

// Send the email:
$transport = new Mail\Transport\Sendmail();
$transport->send($mail);
*/