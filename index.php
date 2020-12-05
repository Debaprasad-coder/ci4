<?php
	/*
	echo '<pre>';
	print_r($_SERVER);
	exit;
	*/
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'public';
	} else {
		$uri = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'public';
	}
	//$uri .= $_SERVER['HTTP_HOST'];
	header('Location: '.$uri);
	exit;
?>
