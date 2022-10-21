<?php
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
?>
<?php

	define('MAGICNUMBER', true);
	include 'unlock.php';

	$URL = 'https://afsaccess4.njit.edu/~rd448/middleCS490Beta.php';

	$req = login($_POST['username'], $_POST['password'], $URL);

	$loginRespJSON = json_decode($req, true);

    debug_to_console($loginRespJSON);

	if($loginRespJSON['resp'] == 'Teacher'){
		$_SESSION['logon'] = true;
		$_SESSION['teacher'] = true;
        $_SESSION['user'] = $_POST['username'];
	}
	else if($loginRespJSON['resp'] == 'Student'){
		$_SESSION['logon'] = true;
		$_SESSION['student'] = true;
        $_SESSION['user'] = $_POST['username'];
	}

	echo $req;

	function login($username, $password, $URL){
		$post_params = http_build_query(array('RequestType' => 'login', 'data' => array('username' => $username, 'password' => $password)));
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