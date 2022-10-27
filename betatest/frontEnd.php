<?php
	define('MAGICNUMBER', true);
	include 'unlock.php';

	$URL = 'https://afsaccess4.njit.edu/~ac235/middleEnd.php'; //andrew

	$req = login($_POST['username'], $_POST['password'], $URL);

	$loginRespJSON = json_decode($req, true);

	if($loginRespJSON == 'Teacher'){
		$_SESSION['logon'] = true;
		$_SESSION['teacher'] = true;
        $_SESSION['user'] = $_POST['username'];
	}
	else if($loginRespJSON == 'Student'){
		$_SESSION['logon'] = true;
		$_SESSION['student'] = true;
        $_SESSION['user'] = $_POST['username'];
	}

	echo $req;

	function login($username, $password, $URL){
		$post_params = http_build_query(array('RequestType' => 'login', 'data' => array('username' => $username, 'password' => $password)));
		$ch = curl_init();
		$options = array(CURLOPT_URL => $URL,
			    CURLOPT_HTTPHEADER => array('Content-type:application/x-www-form-urlencoded'),
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_POST => TRUE,
				CURLOPT_POSTFIELDS => $post_params);
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
?>