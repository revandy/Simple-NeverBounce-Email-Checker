<?php
	/*
		Created by Revandy Satria on 30 July 2018 12:36 AM
		Read More Documentation API https://neverbounce.com/help/understanding-and-downloading-results/result-codes#valid
	*/
function checkEmail($e, $secretKey, $apiUsername){
	// Load files via Composer
	require ('vendor/autoload.php');
	// Set credentials
	\NeverBounce\API\NB_Auth::auth($secretKey, $apiUsername);
	// Supply individual emails
	$email = $e;
	// Verify email
	$resp = \NeverBounce\API\NB_Single::app()->verify($email);
	// Handle the response here, view NB_Single for other helper methods or access
	// the response directly from $resp->response
	if($resp->response->result == 0) file_put_contents('valid.txt', $email.PHP_EOL, FILE_APPEND) . print "$email - Valid Email".PHP_EOL;
	else file_put_contents('invalid.txt', $email.PHP_EOL, FILE_APPEND) . print "$email - Not Valid".PHP_EOL;
	return ($resp->response->result);
}
/*API Authentication*/
$secretKey = "";
$apiUsername = "";
/*API Authentication*/
$myfile = file_get_contents('email.txt');
$explode = explode(PHP_EOL, $myfile);
foreach($explode as $e) checkEmail($e, $secretKey, $apiUsername);
