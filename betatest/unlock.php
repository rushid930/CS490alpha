<?php
	$LOGIN_PATH = 'https://afsaccess4.njit.edu/~rd448/login.php';
	$STUDENT_PATH = 'https://afsaccess4.njit.edu/~rd448/student.php';
	$TEACHER_PATH = 'https://afsaccess4.njit.edu/~rd448/teacherNav.php';
	
	if(!defined('MAGICNUMBER')){
		header("Location:" . $LOGIN_PATH);
		die("No direct access");
	}

	session_start();

    if($_SESSION['logon']){
		if($_SESSION['student'])
	        header("Location:" . $STUDENT_PATH);
        else if($_SESSION['teacher'])
			header("Location:" . $TEACHER_PATH);
        die("Bypassing...");
    }
?>