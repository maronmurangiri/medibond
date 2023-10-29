<?php

// This file is the second step in the checkout process.
// It takes and validates the billing information.
// This script is begun in Chapter 10.

// Require the configuration before any PHP code:
require('./includes/config.inc.php');

// Start the session:
include'head.php';
//session_start();

// The session ID is the user's cart ID:
$uid = $_SESSION['user_id'];

// Check that this is valid:
if (!isset($_SESSION['customer_id'])) { // Redirect the user.
	$location = 'checkout.php';
	header("Location: $location");
	exit();
}

// Require the database connection:
require(MYSQL);

// Validate the billing form...

// For storing errors:
$billing_errors = array();

// Check for a form submission:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	if (get_magic_quotes_gpc()) {
		$_POST['cc_first_name'] = stripslashes($_POST['cc_first_name']);
		// Repeat for other variables that could be affected.
	}

	// Check for a first name:
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $_POST['cc_first_name'])) {
		$cc_first_name = $_POST['cc_first_name'];
	} else {
		$billing_errors['cc_first_name'] = 'Please enter your first name!';
	}

	// Check for a last name:
	if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $_POST['cc_last_name'])) {
		$cc_last_name  = $_POST['cc_last_name'];
	} else {
		$billing_errors['cc_last_name'] = 'Please enter your last name!';
	}
	
	// Check for a valid credit card number...
	// Strip out spaces or hyphens:
	$cc_number = str_replace(array(' ', '-'), '', $_POST['cc_number']);
	
	// Validate the card number against allowed types:
	if (!preg_match ('/^4[0-9]{12}(?:[0-9]{3})?$/', $cc_number) // Visa
	&& !preg_match ('/^5[1-5][0-9]{14}$/', $cc_number) // MasterCard
	&& !preg_match ('/^3[47][0-9]{13}$/', $cc_number) // American Express
	&& !preg_match ('/^6(?:011|5[0-9]{2})[0-9]{12}$/', $cc_number) // Discover
	) {
		$billing_errors['cc_number'] = 'Please enter your credit card number!';
	}
	
	// Check for an expiration date:
	if ( ($_POST['cc_exp_month'] < 1 || $_POST['cc_exp_month'] > 12)) {
		$billing_errors['cc_exp_month'] = 'Please enter your expiration month!';		
	}

	if ($_POST['cc_exp_year'] < date('Y')) {
		$billing_errors['cc_exp_year'] = 'Please enter your expiration year!';
	}
	
	// Check for a CVV:
	if (preg_match ('/^[0-9]{3,4}$/', $_POST['cc_cvv'])) {
		$cc_cvv = $_POST['cc_cvv'];
	} else {
		$billing_errors['cc_cvv'] = 'Please enter your CVV!';
	}
	
	// Check for a street address:
	if (preg_match ('/^[A-Z0-9 \',.#-]{2,160}$/i', $_POST['cc_address'])) {
		$cc_address  = $_POST['cc_address'];
	} else {
		$billing_errors['cc_address'] = 'Please enter your street address!';
	}
		
	// Check for a city:
	if (preg_match ('/^[A-Z \'.-]{2,60}$/i', $_POST['cc_city'])) {
		$cc_city = $_POST['cc_city'];
	} else {
		$billing_errors['cc_city'] = 'Please enter your city!';
	}

	// Check for a state:
	if (preg_match ('/^[A-Z0-9]{2}$/', $_POST['cc_state'])) {
		$cc_state = $_POST['cc_state'];
	} else {
		$billing_errors['cc_state'] = 'Please enter your state!';
	}

	// Check for a zip code:
	if (preg_match ('/^(\d{5}$)|(^\d{5}-\d{4})$/', $_POST['cc_zip'])) {
		$cc_zip = $_POST['cc_zip'];
	} else {
		$billing_errors['cc_zip'] = 'Please enter your zip code!';
	}
	
if (empty($billing_errors)) { // If everything's OK...

		// Convert the expiration date to the right format:
		$cc_exp = sprintf('%02d%d', $_POST['cc_exp_month'], $_POST['cc_exp_year']);

		// Check for an existing order ID:
		if ((isset($_SESSION['order_id'])) && isset($_SESSION['order_total'])) { // Use existing order info:
			echo($_SESSION['order_id']);
			//echo($_SESSION['order_total']);
			$order_id = $_SESSION['order_id'];
			//echo($_SESSION['order_total']);
			$order_total = $_SESSION['order_total'];
		} else { // Create a new order record:


			// Get the last four digits of the credit card number:
			$cc_last_four = substr($cc_number, -4);

			// Call the stored procedure:
			$shipping = $_SESSION['shipping'] * 100;
			echo($_SESSION['customer_id'].$uid.$shipping.$cc_last_four);
			$r = mysqli_query($dbc, "CALL add_order({$_SESSION['customer_id']}, '$uid', $shipping, $cc_last_four, @total, @oid)");

			// Confirm that it worked:
			if ($r) {

				// Retrieve the order ID and total:
				$r = mysqli_query($dbc, 'SELECT @total, @oid');
				if (mysqli_num_rows($r) == 1) {
					list($order_total, $order_id) = mysqli_fetch_array($r);
					
					// Store the information in the session:
					$_SESSION['order_total'] = $order_total;
					$_SESSION['order_id'] = $order_id;
					
				} else { // Could not retrieve the order ID and total.
					unset($cc_number, $cc_cvv, $_POST['cc_number'], $_POST['cc_cvv']);
					trigger_error('Your order could not be processed due to a system error. We apologize for the inconvenience.');
				}
			} else { // The add_order() procedure failed.
				unset($cc_number, $cc_cvv, $_POST['cc_number'], $_POST['cc_cvv']);
				trigger_error('Your order could not be processed due to a system error. We apologize for the inconvenience.');
			}
			
		} // End of isset($_SESSION['order_id']) IF-ELSE.
		echo($_SESSION['order_total']);
		// ------------------------
		// Process the payment!
	if (isset($order_id, $order_total)){


				// Make the request to the payment gateway:
				require('vendor/autoload.php');
				require_once 'constants/SampleCodeConstants.php';

				//use net\authorize\api\contract\v1 as AnetAPI;
 				// use net\authorize\api\controller as AnetController;
			//	if (isset($order_id,$order_total)) {
 				 define("AUTHORIZENET_LOG_FILE", "phplog"); 


    /* Create a merchantAuthenticationType object with authentication details  $merchantAuthentication
       retrieved from the constants file */
   		$merchantAuthentication = new net\authorize\api\contract\v1\MerchantAuthenticationType();
   		$merchantAuthentication->setName(\SampleCodeConstants::MERCHANT_LOGIN_ID);
   		$merchantAuthentication->setTransactionKey(\SampleCodeConstants::MERCHANT_TRANSACTION_KEY);

		//set the transaction's refId
    	$refId = 'ref' . time();

				//$aim = new AuthorizeNetAIM(API_LOGIN_ID, TRANSACTION_KEY);

				// Are we testing?
				//$aim->setSandbox(true);

    		//create the payment data for a credit card
		$creditCard = new net\authorize\api\contract\v1\CreditCardType();
		echo($cc_exp.$cc_cvv.$cc_state);
   		$creditCard->setCardNumber($cc_number);
   		$creditCard->setExpirationDate($cc_exp);
   		$creditCard->setCardCode($cc_cvv);

		//Add the paymen data to a payment object.
    	$paymentOne = new net\authorize\api\contract\v1\PaymentType();
    	$paymentOne->setCreditCard($creditCard);

   		 //create order information
   		$order = new net\authorize\api\contract\v1\OrderType();
    	$order->setInvoiceNumber($order_id);
   		$order->setDescription("Golf Shirts");

    		//set the customer's Bill To address
    	$customerAddress = new net\authorize\api\contract\v1\CustomerAddressType();
    	$customerAddress->setFirstName($cc_first_name);
    	$customerAddress->setLastName($cc_last_name);
    	$customerAddress->setCompany("medibond");
    	$customerAddress->setAddress($cc_address);
   		$customerAddress->setCity($cc_city);
    	$customerAddress->setState($cc_state);
    	$customerAddress->setZip($cc_zip);
    	$customerAddress->setCountry("Kenya");

		//set the customer's identifying information
    	$customerData = new net\authorize\api\contract\v1\CustomerDataType();
    	$customerData->setType("individual");
    	$customerData->setId("99999456654");
   		$customerData->setEmail($_SESSION['email']);

    		//Add values for transaction setting
    	$duplicateWindowSetting = new net\authorize\api\contract\v1\SettingType();
    	$duplicateWindowSetting->setSettingName("duplicateWindow");
    	$duplicateWindowSetting->setSettingValue("60");

    		//Add some mearchat defined fields. These fields wont be stored woth the transaction, but will be echoed back in the response.
    	$merchantDefinedField1 = new net\authorize\api\contract\v1\UserFieldType();
    	$merchantDefinedField1->setName("customerLoyaltyNum");
    	$merchantDefinedField1->setValue("1128836273");

    	$merchantDefinedField2 = new net\authorize\api\contract\v1\UserFieldType();
    	$merchantDefinedField2->setName("favoriteColor");
    	$merchantDefinedField2->setValue("blue");

    	//create a transactionRequetType object and add the previous objects to it
		$transactionRequestType = new net\authorize\api\contract\v1\TransactionRequestType();
		$transactionRequestType ->setTransactionType("authCaptureTransaction");
				// Set the amount (in dollars):
		//echo($order_total);
		$transactionRequestType->setAmount($order_total/100);
		$transactionRequestType->setOrder($order);
		$transactionRequestType->setPayment($paymentOne);
		$transactionRequestType->setBillTo($customerAddress);
		$transactionRequestType->setCustomer($customerData);
		$transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
    	$transactionRequestType->addToUserFields($merchantDefinedField1);
    	$transactionRequestType->addToUserFields($merchantDefinedField2);

    	//assemble the complete transaction request
    	$request = new net\authorize\api\contract\v1\CreateTransactionRequest();
    	$request->setMerchantAuthentication($merchantAuthentication);
    	$request->setRefId($refId);//$transactionRequestType
    	$request->setTransactionRequest($transactionRequestType);

		$controller = new net\authorize\api\controller\CreateTransactionController($request);

		$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);


				


				// Set the invoice number:
				/*$aim->invoice_num = $order_id;

				// Set the customer ID:
				/*$aim->cust_id = $_SESSION['customer_id'];

				// Set the customer's CC info:
				$aim->card_num = $cc_number;
				$aim->exp_date = $cc_exp;
				$aim->card_code = $cc_cvv;

				// Set the customer's information:
				$aim->first_name = $cc_first_name;
				$aim->last_name = $cc_last_name;
				$aim->address = $cc_address;
				$aim->state = $cc_state;
				$aim->city = $cc_city;
				$aim->zip = $cc_zip;
				$aim->email = $_SESSION['email'];*/

				// $aim->addLineItem();
				// $aim->setCustomField('thing', 'value');
				// $aim->phone;
				// $aim->tax
				// $aim->freight
				// $aim->description    authorizeOnly()

				// Add slashes to two text values:
				if($response != null){
					//$reason = addslashes($response->getTransactionResponse());
					//$full_response = addslashes($response->response);

					if($response->getMessages()->getResultCode()=="Ok"){
						$tresponse = $response->getTransactionResponse();
						if ($tresponse!=null && $tresponse -> getMessages()!= null) {
							$desc = $tresponse->getMessages()[0]->getDescription();
							$code = $tresponse->getMessages()[0]->getCode();
							$transId = $tresponse->getTransId();
							$rCode = $tresponse->getResponseCode();
							$authCode = $tresponse->getAuthCode();
							echo($authCode);
							echo($order_id.'total'.$order_total);
							$resp = ($tresponse->getResponseCode().'|'.$tresponse->getMessages()[0]->getDescription());
							echo('resp'.$resp.'description'.$desc.'transId'.$transId.'responsecode'.$rCode);

								//echo($tresponse->getMessages()[0]->getDescription());
				//$r = mysqli_query($dbc, "CALL add_transaction($order_id, '{$response->transaction_type}', $order_total, {$response->response_code}, '$reason', {$response->transaction_id}, '$full_response')");	
				$r = mysqli_query($dbc, "CALL add_transaction($order_id,'AUTH_ONLY', $order_total,{$rCode},'{$desc}',{$transId},'{$resp}')");
				//$location = 'final.php';
				//	header("Location: $location");
					//exit();
			//	if ($r) {
					// Add the transaction info to the session:
					$_SESSION['response_code'] = $rCode;
					
					// Redirect to the next page:
					$location = 'final.php';
					header("Location: $location");
					exit();

			//	} 		
			}
				/*	else{
							$failure = "Unable to INSERT into DB: " .mysqli_error($dbc);
							echo($failure);
					}*/

				echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n"; 
				echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";

							echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n";
                echo " Transaction Response Code: " . $tresponse->getResponseCode() . "\n";
                echo " Message Code: " . $tresponse->getMessages()[0]->getCode() . "\n";
                echo " Auth Code: " . $tresponse->getAuthCode() . "\n";
                echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";
                //echo($tresponse->getMessages()[0]);
							
						}
					else{ echo "Transaction Failed \n";
            $tresponse = $response->getTransactionResponse();
        
            if ($tresponse != null && $tresponse->getErrors() != null) {
                echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
            } else {
                echo " Error Code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
                echo " Error Message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";
           	 		}
            	}
			}else{echo "Transaction Failed \n";
            $tresponse = $response->getTransactionResponse();
        
            if ($tresponse != null && $tresponse->getErrors() != null) {
                echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
            } else {
                echo " Error Code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
                echo " Error Message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";
            }
        }
		}else {
        echo  "No response returned \n";
    }

									
			
								// Upon success, redirect:
					/*if ($response->approved) {
					
							// Add the transaction info to the session:
						$_SESSION['response_code'] = $response->response_code;
					
							// Redirect to the next page:
						$location = 'final.php';
						header("Location: $location");
						exit();

					} else { // Do different things based upon the response:

						switch ($response->response_code) {
							case '2': // Declined	
								$message = $response->response_reason_text . ' Please fix the error or try another card.';	
							break;
							case '3': // Error	
							$message = $response->response_reason_text . '  Please fix the error or try another card.';	
							break;
							case '4': // Held for review	
								$message = "The transaction is being held for review. You will be contacted ASAP about your order. We apologize for any inconvenience.";			
							break;
						}
								
				}	} */// End of $response_array[0] IF-ELSE.
			
		} // End of isset($order_id, $order_total) IF.
	
		// ------------------------

	} // Errors occurred IF

//} // End of REQUEST_METHOD IF.
							
// Include the header file:
$page_title = 'Medicine+ - Checkout - Your Billing Information';
include('includes/checkout_header.html');

// Get the cart contents:
$r = mysqli_query($dbc, "CALL get_shopping_cart_contents('$uid')");

if (mysqli_num_rows($r) > 0) { // Products to show!
	if (isset($_SESSION['shipping_for_billing']) && ($_SERVER['REQUEST_METHOD'] !== 'POST')) {
		$values = 'SESSION';
	} else {
		$values = 'POST';
	}
	include('./views/billing.html');
} else { // Empty cart!
	include('views/emptycart.html');
}

// Finish the page:
include('includes/footer.html');
?>