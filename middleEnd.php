<?php

$backUrl = 'https://web.njit.edu/~ss4366/backEnd.php';
$frontUrl = 'https://web.njit.edu/~rd448/frontEnd.php';
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
$responseB = curl_exec($chBack);
curl_close($chBack);


/*if(isset($username) && isset($password)){
    $message = 'Authenticated';
} 
else{
    $message = 'Denied';
}
*/

if(strpos($responseF, "Invalid Username")==false){
    $message = 'Authenticated';
}
else{
    $message = 'Denied';
}

$decoded_json = json_decode($responseB, true);
$decoded_json['respNJIT'] = $message;
//json_decode($message);
$finalJSON = json_encode($decoded_json, JSON_PRETTY_PRINT);
echo $finalJSON;

?>