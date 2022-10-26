<?php
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    //echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
?>
<?php

$backurl = 'https://afsaccess4.njit.edu/~rd448/backEndCS490Betha.php';

$requestID = $_POST['RequestType'];
$data = $_POST['data'];
//debug_to_console($requestID);
//debug_to_console($data);
//debug_to_console($backurl);

if ($requestID == 'login'){
        $post = http_build_query(array('RequestType' => $requestID, 'data' => $data));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $backurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $result = curl_exec($ch);
        echo $result;
        curl_close($ch);
}

elseif ($requestID == 'CreateQuestion'){
        $datas = http_build_query(array('RequestType' => $requestID, 'data' => $data));
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $backurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
        
        $result = curl_exec($ch);
        //debug_to_console($result);

        echo $result;
        curl_close($ch);
}
        
elseif ($requestID == 'GetQuestions'){
        $datas = http_build_query(array('RequestType' => $requestID, 'data' => $data));
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $backurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
        
        $result = curl_exec($ch);
        echo $result;
        curl_close($ch);
}

function str_flatten($delim, &$arr){
        foreach($arr as &$a)
                $a = implode($delim, $a);
}

?>