<?php
	$LOGIN_PATH = 'https://afsaccess4.njit.edu/~rd448/login.php';

	session_start();
	session_destroy();

	unset($_SESSION['teacher']);
	unset($_SESSION['student']);
	unset($_SESSION['logon']);
    unset($_SESSION['user']);

	header("Location:" . $LOGIN_PATH);
?>