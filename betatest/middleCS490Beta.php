<?php

//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
//ini_set('display_errors', 1);

$backurl = 'https://afsaccess4.njit.edu/~rd448/backEndCS490Betha.php';

$requestID = $_POST['RequestType'];
$data = $_POST['data'];
//Due to no connection of post being sent to back, the back would need the data
//To call $data['RequestType'] to get the request type

if ($requestID == 'login'){
        $post = http_build_query(array('RequestType' => $requestID, 'data' => $data));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $backurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $result = curl_exec($ch);
        echo $result; //Echos login return from back to front
        curl_close($ch);
}

function str_flatten($delim, &$arr){
        foreach($arr as &$a)
                $a = implode($delim, $a);
}

?>