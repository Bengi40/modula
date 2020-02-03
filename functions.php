<?php
function checkInput($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function isEmail($email)
{
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function getIp()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

function verifCaptcha($reponse, $ip) {
	$secret = "6LfBTNUUAAAAALh9MR_XihQYdV0o1ynihKE-dPVj";
	$response = $reponse;
    $remoteip = $ip;
    $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
		. $secret
		. "&response=" . $response
		. "&remoteip=" . $remoteip;

    $decode = json_decode(file_get_contents($api_url), true);
	
	return $decode;   
}
