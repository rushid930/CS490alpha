<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  //Detectes run-time errors
ini_set('display_errors' , 1);

//DB credentials
$server = 'sql1.njit.edu';
$dbuser = 'ss4366';
$pass = 'Ss!98119811';
$dbname = 'ss4366';
$database = mysqli_connect($server, $dbuser, $pass, $dbname);

if(mysqli_connect_errno($database)){
 die("connection error".mysqli_connect_error($database));
}

$request = $_POST['RequestType'];
$data = $_POST['data'];

if ($request == 'login'){
	$username = $data['username'];
	$password = $data['password'];

	$s="SELECT * FROM `information` WHERE username='$username' AND password='$password'";
	($t=mysqli_query($database,$s)) or die( mysqli_error( $database )); #Executes query
	$num=mysqli_num_rows($t);//returns the number of rows in $t.
	if ($num == 0){
		$resp = 'backNoexist';
    }
	else{
		$r=mysqli_fetch_array($t);
		$passB=$r['password'];

		if ($password == $passB)
			$resp = $r['Type'];
		else
			$resp = 'backNo';
	}
	//Returns the JSON representation of $resp
	echo json_encode($resp);
}

mysqli_close($database);

?>