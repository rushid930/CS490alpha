<?php


$backUrl = 'https://web.njit.edu/~ss4366/back-end.php';
$frontUrl = 'https://web.njit.edu/~rd448/login.php';
$username = $_POST['username'];
$password = $_POST['password'];

$login = array('username'=>$username, 'password'=>$password);


$chFront = curl_init();

curl_setopt($chFront, CURLOPT_URL, '$frontUrl');
curl_setopt($chFront, CURLOPT_RETURNTRANSFER, true);
curl_setopt($chFront, CURLOPT_POST, 1);
curl_setopt($chFront, CURLOPT_POSTFIELDS, $login);
$responseF = curl_exec($chFront);
curl_close($chFront);


$chBack = curl_init();

curl_setopt($chBack, CURLOPT_URL, '$backUrl');
curl_setopt($chBack, CURLOPT_RETURNTRANSFER, true);
curl_setopt($chBack, CURLOPT_POST, 1);
curl_setopt($chBack, CURLOPT_POSTFIELDS, $login);
$responeB = curl_exec($chBack);
curl_close($chBack);


if(isset($username && $password)){
    $message = 'Authenticated';
} 
else{
    $message = 'Denied';
}

json_decode($message);

?>