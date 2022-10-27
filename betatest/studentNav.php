<?php
	define('MAGICNUMBER', true);
	include 'restrict.php';
?>
<html>
	<head>
		<title>Student Nav Bar</title>
	</head>
	<body>
		<div id="nav">
		<ul id="navlist">
			<li class="NavItems"><a class="NavLinks" href='#home'>Home</a></li>
			<li class="NavItems"><a class="NavLinks" href='#exam'>Take Exams</a></li>
			<li class="NavItems"><a class="NavLinks" href='#review'>Review Exams</a></li>
	    	<li class="NavLogout"><a class="NavLinks" href='https://afsaccess4.njit.edu/~rd448/logout.php'>LOGOUT</a></li>
		</ul>
		</div>

		<div id="main"></div>

		<script src="studentNav.js"></script>
		<div id="subscript"></div>
	</body>
</html>