<?php
	$LOGIN_PATH     = 'https://afsaccess4.njit.edu/~rd448/login.php';
	$STUDENT_PATH   = 'https://afsaccess4.njit.edu/~rd448/studentNav.php';
	$TEACHER_PATH   = 'https://afsaccess4.njit.edu/~rd448/teacherNav.php';

	$STUDENT_PAGES = array('studentNav.php', 'studentExam.php', 'studentTake.php', 'studentReview.php', 'studentView.php', 'studentLanding.php');

	$TEACHER_PAGES = array('teacherNav.php', 'teacherExam.php', 'teacherCompleted.php', 'teacherGrade.php', 'teacherQuestion.php', 'teacherLanding.php');

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