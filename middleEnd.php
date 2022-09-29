<?php
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
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
	}
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