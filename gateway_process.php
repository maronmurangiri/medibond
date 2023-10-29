<?php
//require('./includes/config.php');
if ('live') {
 define ('GATEWAY_API_URL', 'https://secure.authorize.net/gateway/transact.dll');
} else {
 define ('GATEWAY_API_URL', 'https://test.authorize.net/gateway/transact.dll');
}


$data['x_login'] = '55nLqQ5L2';
$data['x_tran_key'] = '2Lazr67xX97AL9Hj';

$data['x_version'] = '3.1';
$data['x_delim_data'] = 'TRUE';
$data['x_delim_char'] = '|';
$data['x_relay_response'] = 'FALSE';

$data['x_method'] = 'CC';
$data['x_amount'] = $order_total;
$data['x_invoice_num'] = $order_id;
$data['x_cust_id'] = $customer_id;

$post_string = '';
foreach( $data as $k => $v ) {
$post_string .= "$k=" . urlencode($v) . "&";
}
$post_string = rtrim($post_string, '& ');

/*x_type=AUTH_ONLY&x_card_num=4556510523894&x_exp_date=062010&x_card_code=890&x_first_name=Larry&x_last_name=Ullman&x_address=100+Main+Street+Apt+2B&x_state=NH&x_city=Anytown&x_zip=65894&x_login=75sqQ96qHEP8&x_tran_key=7r83Sb4HUd58Tz5p&x_version=3.1&x_delim_data=TRUE&x_delim_char=%7C&x_relay_response=FALSE&x_method=CC&x_amount=309.82&x_invoice_num=21&x_cust_id=27*/

$request = curl_init(GATEWAY_API_URL);
curl_setopt($request, CURLOPT_HEADER, 0);
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($request, CURLOPT_POSTFIELDS, $post_string);
curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE);

$response = curl_exec($request);
curl_close ($request);

$response_array = explode($data["x_delim_char"], $response);