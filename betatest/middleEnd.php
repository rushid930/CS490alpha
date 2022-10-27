<?php
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    //echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
?>
<?php

$backurl = 'https://afsaccess4.njit.edu/~ss4366/backEnd.php'; //sumit

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

elseif ($requestID == 'createExam'){
        $datas = http_build_query(array('RequestType' => $requestID, 'data' => $data));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $backurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);

        $result = curl_exec($ch);
        echo $result;
        curl_close($ch);
}

elseif ($requestID == 'listExams'){
        $datas = http_build_query(array('RequestType' => $requestID, 'data' => $data));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $backurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);

        $result = curl_exec($ch);
        echo $result;
        curl_close($ch);
}

elseif($requestID == 'showExam'){
        $datas = http_build_query(array('RequestType' => $requestID, 'data' => $data));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $backurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);

        $result = curl_exec($ch);
        echo $result;
        curl_close($ch);
}

elseif($requestID == 'submitExam'){ //auto-grader
        $ARGS_START_DELIMITER = "(";
        $ARGS_END_DELIMITER = ")";
        $CASE_DELIMITER = "?";
        $RETURN_DELIMITER = ":";

        $username = $data['username'];
        $examName = $data['examName'];
        $questionIDs = $data['questionID'];
        $answers = $data['answers'];
        $maxScores = $data['points'];

        $tData = array('questionsid' => $questionIDs);
        $requesting = 'retrieve';

        $datas = http_build_query(array('RequestType' => $requesting, 'data' => $tData));
        $chr = curl_init();

        curl_setopt($chr, CURLOPT_URL, $backurl);
        curl_setopt($chr, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($chr, CURLOPT_POSTFIELDS, $datas);

        $resultEn = curl_exec($chr);
        curl_close($chr);

        $result = json_decode($resultEn, true);

        $scores = array();
        $comments = array();
        $expecteds = array();
        $resulting = array();

        $deductTest = array();
        $deductName = array();

        for($i = 0; $i < count($questionIDs); ++$i){
                $topic = $result[$i]['topic'];
                $question = $result[$i]['questText'];
                $testcasesS = $result[$i]['questTest'];
                $answer = $answers[$i];
                $functionName = substr($testcasesS, 0, strpos($testcasesS,
                $ARGS_START_DELIMITER));
                $fname = substr($answer, 0, strpos($answer, $ARGS_START_DELIMITER));
                $fname = preg_replace("/def /", "", $fname);
                $testcases = explode($CASE_DELIMITER, $testcasesS);
                $inputs = array();
                $expectedReturns = array();
                $S = $maxScores[$i];
                $testFile =
                '/afs/cad.njit.edu/u/n/p/np595/public_html/CS490Work/test.py';
                $NAMED = 5;
                $TESTD = (int)(($S - $NAMED)/count($testcases));

                $totDed = array();
                $p = 0;
                foreach($testcases as $k){
                        $expectedReturns[$p] = substr($k, strpos($k,
                        $RETURN_DELIMITER) + 1);

                        $inputs[$p] = substr($k, strpos($k,
                        $ARGS_START_DELIMITER), strpos($k,
                        $ARGS_END_DELIMITER) - strpos($k,
                        $ARGS_START_DELIMITER) + 1);
                        $p = 1 + $p;
                }
                clearstatcache();
                file_put_contents($testFile, $answer);

                foreach($inputs as $l)
                        file_put_contents($testFile, "\nprint($fname$l)", FILE_APPEND);

                $returnSet = array();

                exec("python test.py", $returnSet, $exec_return_code);

                if(count($returnSet) == count($expectedReturns)){
                        for($j = 0; $j < count($expectedReturns); ++$j){
                                $returnSet[$j] != $expectedReturns[$j] ?
                                $totDed[$j] = $TESTD : $totDed[$j] = 0;
                        }
                        //$deductNoRun[$i] = 0;
                }

                else if($exec_return_code){
                        for($j = 0; $j < count($expectedReturns); ++$j){
                                if(!isset($returnSet[$j]))
                                $returnSet[$j] = "(Python crashed!)";

                                $returnSet[$j] != $expectedReturns[$j] ?
                                $totDed[$j] = $TESTD : $totDed[$j] = 0;
                        }
                }

                $deductTest[$i] = $totDed;

                $a = strtok($answer, "\n");
                while(ctype_space($a))
                        $a = strtok("\n");
                $r = preg_match('/def[ \t]+' . $functionName . '[ \t]*\(.+/', $a);

                $r ? $deductName[$i] = 0 : $deductName[$i] = $NAMED;

                $scores[$i] = $maxScores[$i] - $deductNoRun[$i] -
                $deductName[$i];

                foreach($totDed as $test)
                        $scores[$i] -= $test;
                $comments[$i] = "";
                $expecteds[$i] = $expectedReturns;
                $resulting[$i] = $returnSet;
        }

        str_flatten("HACKMAGICK", $expecteds);
        str_flatten("HACKMAGICK", $resulting);
        str_flatten(", ", $deductTest);


        $tData = array('comments' => $comments, 'username' => $username, 'examName' => $examName, 'questionID' => $questionIDs, 'answers' => $answers, 'scores' => $scores, 'maxScores' => $maxScores, 'expectedAnswers' => $expecteds, 'resultingAnswers' => $resulting, 'pointsDeductedCorrectName' => $deductName, 'pointsDeductedPerTest' => $deductTest);

        $datas = http_build_query(array('RequestType' => 'gradingExam', 'data' => $tData));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $backurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);

        $resulting = curl_exec($ch);
        curl_close($ch);
        echo $resulting;
}

elseif($requestID == 'showGradedExam'){
        $datas = http_build_query(array('RequestType' => $requestID, 'data' => $data));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $backurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);

        $result = curl_exec($ch);
        echo $result;
        curl_close($ch);
}

elseif($requestID == 'modifyGradedExam'){
        $datas = http_build_query(array('RequestType' => $requestID, 'data' => $data));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $backurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);

        $result = curl_exec($ch);
        echo $result;
        curl_close($ch);
}

elseif($requestID == 'listGradedExams'){
        $datas = http_build_query(array('RequestType' => $requestID, 'data' =>
        $data));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $backurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);

        $result = curl_exec($ch);
        echo $result;
        curl_close($ch);
}

elseif($requestID == 'listGradedExamsStudent'){
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