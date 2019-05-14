<?php
		header("Access-Control-Allow-Origin: *");
		
	if(!isset($_POST['subject']) || !isset($_POST['msg']) || !isset($_POST['to'])) 
	{
		  // set response code - 404 because one of the parameter are empty
		http_response_code(404);
		// tell the caller the error
		echo json_encode(
			array("message" => "All parameter are required.")
		);
		exit();
	}
	if (!filter_var($_POST['to'], FILTER_VALIDATE_EMAIL))
	{
		// set response code - 404 because email is invalid
		http_response_code(404);
		// tell the caller the error
		echo json_encode(
			array("message" => "Email format is invalid.")
		);
		exit();
	}
	$headers  = "";
	if( !IsNullOrEmptyString($_POST['fromName']) || !IsNullOrEmptyString($_POST['fromEmail']))
	{
		$headers  .= "From: ";
	}
	if( !IsNullOrEmptyString($_POST['fromName']))
	{
		$headers  .= $_POST['fromName'];
	}
	if( !IsNullOrEmptyString($_POST['fromEmail']))
	{
		$headers  .= "<".$_POST['fromEmail'].">";
	}
	if( !IsNullOrEmptyString($_POST['fromName']) || !IsNullOrEmptyString($_POST['fromEmail']))
	{
		$headers  .= "\n";
	}
	if( !IsNullOrEmptyString($_POST['replyToEmail']))
	{
		$headers  .= "Reply-To: <".$_POST['replyToEmail'].">\n";
	}
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

	if (!mail($_POST['to'], $_POST['subject'], $_POST['msg'], $headers)) {
		$errorMessage = error_get_last()['message'];
		// set response code - 503 because email don't send
		http_response_code(503);
		// tell the caller the error
		echo json_encode(
			array("message" => "Email not send. Details : ".$errorMessage)
		);
	}
	else {
		http_response_code(200);
		// tell the caller that the email was send
		echo json_encode(
			array("message" => "Email send successfully")
		);
	}

	function IsNullOrEmptyString($str){
		return (!isset($str) || trim($str) === '');
	}
?>