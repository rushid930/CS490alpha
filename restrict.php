<?php
	$LOGIN_PATH     = 'https://afsaccess4.njit.edu/~rd448/login.php';
	$STUDENT_PATH   = 'https://afsaccess4.njit.edu/~rd448/student.php';
	$TEACHER_PATH   = 'https://afsaccess4.njit.edu/~rd448/teacher.php';

	$STUDENT_PAGES = array('studentLanding.php');

	$TEACHER_PAGES = array('teacherLanding.php');

	if (!defined('MAGICNUMBER')){
		header("Location:" . $LOGIN_PATH);
		die("No direct access.");
	}

	session_start();
	
	if (!$_SESSION['logon']){
		header("Location:" . $LOGIN_PATH);
		die("Restricted");
	}
	else if((in_array(basename($_SERVER['SCRIPT_FILENAME']), $TEACHER_PAGES)) && !$_SESSION['teacher']){
		header("Location:" . $STUDENT_PATH);
		die("Restricted");
	}
	else if((in_array(basename($_SERVER['SCRIPT_FILENAME']), $STUDENT_PAGES)) && !$_SESSION['student']){
		header("Location:" . $TEACHER_PATH);
		die("Restricted");
	}
?>