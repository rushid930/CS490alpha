<?php
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

<<<<<<< HEAD

$backUrl = 'https://web.njit.edu/~ss4366/back-end.php';
$frontUrl = 'https://web.njit.edu/~rd448/login.php';
$username = $_POST['username'];
$password = $_POST['password'];

$login = array('username'=>$username, 'password'=>$password);

//Gather information from front-end URL AKA Rushi's Code
$chFront = curl_init();

curl_setopt($chFront, CURLOPT_URL, '$frontUrl');
curl_setopt($chFront, CURLOPT_RETURNTRANSFER, true);
curl_setopt($chFront, CURLOPT_POST, 1);
curl_setopt($chFront, CURLOPT_POSTFIELDS, $login);
$responseF = curl_exec($chFront);
curl_close($chFront);

//Gathers infromation from back-end URL AKA Sumit's code
$chBack = curl_init();

curl_setopt($chBack, CURLOPT_URL, '$backUrl');
curl_setopt($chBack, CURLOPT_RETURNTRANSFER, true);
curl_setopt($chBack, CURLOPT_POST, 1);
curl_setopt($chBack, CURLOPT_POSTFIELDS, $login);
$responseB = curl_exec($chBack);
curl_close($chBack);

// Checks if user inputted any data into username and password
if(isset($username && $password)){
    $message = 'Authenticated';
} 
else{
    $message = 'Denied';
=======
    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
>>>>>>> 124e454b064ee1a961b0dff306d7fda18bd03345
}
?>
<?php
	session_start();

	debug_to_console($_POST['loginBTN']);
	debug_to_console($_SESSION['auth']);

	if(isset($_POST['loginBTN'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$_SESSION['auth-user'] = [
            'username' => $username,
            'password' => $password
        ];
		
		debug_to_console($_SESSION['auth-user']);
		$_SESSION['auth'] = false;
		debug_to_console($_SESSION['auth']);
		debug_to_console($_SESSION['user-type']);

		header('Location: https://web.njit.edu/~ss4366/authCode.php');
o	}
	else if(isset($_SESSION['auth'])){
		debug_to_console($_SESSION['user-type']);
		$user_type = $_SESSION['user-type'];
		if($user_type == 'Teacher'){                    
			$_SESSION['message'] = "Successful Login";
			header('Location: https://web.njit.edu/~rd448/teacherLanding.php');
		}
		else if($user_type == 'Student'){
			$_SESSION['message'] = "Successful Login";
			header('Location: https://web.njit.edu/~rd448/studentLanding.php');
		}
		else{
			$_SESSION['message'] = "Invalid Credentials";
			header('Location: https://web.njit.edu/~rd448/login.php');
		}
	}
	else{
		header('Location: https://web.njit.edu/~rd448/login.php');
	}

?>