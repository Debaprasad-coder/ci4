<?php

	function getToken($length = 10)
	{
	    $characters = '0123456789@#$%^&*!abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	$token = getToken();
	$to = 'dmparision@yahoo.com';
	$subject = "Password Reset Email";
	$link ="http:://localhost/ci4/resetpassword/$token";
	$message = "
	<html>
		<head>
		<title>Password Reset</title>
		</head>
		<body>
		<p>Please click the below link to reset your password</p>
		<a href=".$link.">
			<button>Click Here </button>
		</a>
		</br>
		</br>
		</br>
		</br>
		".$link."
		</table>
		</body>
	</html>
	";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <webmaster@example.com>' . "\r\n";
	$headers .= 'Cc: dmparision@gmail.com' . "\r\n";

	$mailResponse = mail($to,$subject,$message,$headers);
	var_dump($mailResponse);

?>