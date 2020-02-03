<?php
function checkInput($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function isEmail($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function getIp(){
	$ip = $_SERVER['REMOTE_ADDR'];
//     // if(!empty($_SERVER['HTTP_CLIENT_IP'])){
//     //   $ip = $_SERVER['HTTP_CLIENT_IP'];
//     // }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
//     //   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
//     // }else{
//       $ip = $_SERVER['REMOTE_ADDR'];
//     //}
     return $ip;
}

?>
