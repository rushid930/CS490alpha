<?php
	$URL = 'https://web.njit.edu/~rd448/middleEnd1.php';

	$username = $_POST['username'];
    $password = $_POST['password'];
	$req = login($_POST['username'], $_POST['password'], $URL);
	echo $req;

	function login($username, $password, $URL){
		$post_params = "username=$username&password=$password";
		$ch = curl_init();
		$options = array(CURLOPT_URL => $URL,
			    CURLOPT_HTTPHEADER =>
				array('Content-type:application/x-www-form-urlencoded'),
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_POST => TRUE,
				CURLOPT_POSTFIELDS => $post_params);
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
?>