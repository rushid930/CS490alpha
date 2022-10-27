<?php
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    //echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
?>
<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
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

//debug_to_console($request);
//debug_to_console($data);

if ($request == 'login'){
	$username = $data['username'];
	$password = $data['password'];

	$s="SELECT * FROM `information` WHERE username='$username' AND password='$password'";
	($t=mysqli_query($database,$s)) or die( mysqli_error( $database ));
	$num=mysqli_num_rows($t);
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
	echo json_encode($resp);
}

if ($request == 'CreateQuestion'){
    $topic = $data['topic'];
	$tests = $data['testCases'];
    $difficulty = $data['difficulty'];
    $quest = $data['questionText'];
    
	$query = "SELECT * FROM questionTable WHERE question='$quest'";
	($cursor=mysqli_query($database,$query)) or die( mysqli_error( $database ));
	//$cursor = $database->query($query);
	$num=mysqli_num_rows($cursor);
	if ($num == 0) {
		$query = "INSERT INTO questionTable (questTopic, questTest, questDifficulty, questText) VALUES ('$topic','$tests','$difficulty','$quest');";
		$database->query($query) or die('There was an error saving your question');
		$ans = 'Question successfully saved with id '.$database->insert_id;
		//echo json_encode($ans);
	}
	else
		$ans = 'Question already saved';
	echo json_encode($ans);
}

if ($request == 'GetQuestions'){
	$query="SELECT * from questionTable";
	$cursor = $database->query($query);
	while ($row = $cursor->fetch_array()) {
		$questionID = $row[0];
		$questionTopic = $row[1];
        $questionTest = $row[2];
		$questionDifficulty = $row[3];
		$question=$row[4];
		$ans[] = array(
			"questionID" => $questionID,
			"topic" => $questionTopic,
			"testCases" => $questionTest,
			"difficulty" => $questionDifficulty,
			"questionText" => $question);
	}
	echo json_encode($ans);
}

if ($request == 'listGradedExamsStudent'){
	$username = $data['username'];
	$query = "SELECT DISTINCT examName FROM gradesTable where username='$username' and released='Y'";
	$cursor = $database->query($query);
	if ($cursor->num_rows == 0)
		die('No exams found, try again later...');
	while ($row = $cursor->fetch_assoc()) {
		$exam[] = $row['examName'];
	}
	echo json_encode($exam);
}

if ($request == 'createExam'){
	$examName = $data['examName'];
	$questionID = $data['questionID'];
	$questPoint = $data['questPoint'];

	$query = "SELECT * FROM examsTable WHERE examName = '$examName'";
	$cursor = $database->query($query);
	
	if ($cursor->num_rows == 0) {
		
		foreach (array_combine($questionID, $questPoint) as $q => $p) {
			$query2 = "INSERT INTO examsTable (examName, questionID ,questPoint) VALUES ('$examName', '$q', '$p')";
			$database->query($query2) or die('There was an error saving your Exam');
		}
		$ans =  'Exam successfully saved';
	}
	else
		$ans = 'Exam name conflict';
	
	echo json_encode($ans);
}
if ($request == 'listExams'){//for student 
       
	    $username = $data['username'];
		$query = "SELECT DISTINCT examName FROM examsTable";
		$cursor = $database->query($query);
		if ($cursor->num_rows == 0)
			die('No exams found, try again later...');
		while ($row = $cursor->fetch_assoc()) {
			$exam1[] = $row['examName'];
		}
		$query = $query = "SELECT DISTINCT examName FROM gradesTable where username='$username'";
		$cursor = $database->query($query);
		if ($cursor->num_rows == 0)
			$exam2=array();
		while ($row = $cursor->fetch_assoc()) {
			$exam2[] = $row['examName'];
		}
		$exam=array_diff($exam1,$exam2);
		
		echo json_encode($exam);
}
if ($request == 'showExam'){//for student 
	$examName = $data['examName'];
	$query="SELECT * FROM examsTable INNER JOIN questionTable ON examsTable.questionID = questionTable.questionID WHERE examsTable.examName='$examName'";
	//$query = "SELECT * FROM examsTable, questionTable WHERE examName='$examName'";
	$cursor = $database->query($query);
	if ($cursor->num_rows == 0) die('This exam does not exist, try again later...');
	while ($row = $cursor->fetch_assoc()) {
		$exam[] = array("examName"=>$row['examName'],
						"questiontext"=>$row['questText'],
						"points"=>$row['questPoint'],
						"questionID"=>$row['questionID']);
						
	}

	echo json_encode($exam);	
}
if ($request == 'gradingExam'){
	$username = $data['username'];
	$examName = $data['examName'];
	$questionID = $data['questionID'];
	$answer=$data['answers'];
	$score=$data['scores'];
	$maxScore=$data['maxScore'];
	$comments=$data['comments'];
	$released="N";
	$testCaseExpected = $data['expectedAnswers'];
	$testCaseAnswered = $data['answerResult'];
	$testPointsDeducted = $data['deductedPointsPerEachTest'];
	$correctName = $data['deductedPointsCorrectName'];
  	
	
	$count = count($questionID);
	for($i=0; $i < $count; $i++){
		
		$query = "INSERT INTO gradesTable (questionID,released,username,examName,answers,scores,maxScore,comments,, expectedAnswers, answerResult, pointsDeductedPerTest, pointsDeductedCorrectName)
		VALUES ('$questionID[$i]','$released','$username', '$examName','$answer[$i]','$score[$i]','$maxScore[$i]','$comments[$i]','$testCaseExpected[$i]', '$testCaseAnswered[$i]', '$testPointsDeducted[$i]', '$correctName[$i]')";
		$database->query($query) or die('There was an error saving the grades');
		
	}
	$ans =  "grade successfully saved";
		
		
	echo json_encode($ans);
}
	
 
if ($request == 'showGradedExam'){
	$examName = $data['examName'];
	$username = $data['username'];
	$query="SELECT * FROM gradesTable INNER JOIN questionTable ON gradesTable.questionID = questionTable.questionID WHERE gradesTable.examName='$examName' and gradesTable.username='$username'";
	//$query = "SELECT * FROM examsTable, questionTable WHERE examName='$examName'";
	$cursor = $database->query($query);
	if ($cursor->num_rows == 0) die('This exam does not exist, try again later...');
	while ($row = $cursor->fetch_assoc()) {
		$exam[] = array("username"=>$row['username'],
						"gradesID"=>$row['gradesID'],
						"questionID"=>$row['questionID'],
						"questions"=>$row['question'],
						"answers"=>$row['answer'],
						"scores"=>$row['score'],
						"maxScores"=>$row['maxScore'],
						"comments"=>$row['comments'],
						"expectedAnswers"=>$row['expectedAnswers'],
						"resultingAnswers"=>$row['answerResult'],
						"deductedPointsPerEachTest"=>$row['pointsDeductedPerTest'],
						"deductedPointscorrectName"=>$row['pointsDeductedCorrectName']
						);
	}
	$query2="SELECT DISTINCT released FROM gradesTable WHERE examName='$examName' and username='$username'";
	$cursor = $database->query($query2);
	if ($cursor->num_rows == 0) die('This exam does not exist, try again later...');
	while ($row = $cursor->fetch_assoc()) {
			array_push($exam, $row['released']);
		
	}
    
	echo json_encode($exam);	
}
if ($request == 'modifyGradedExam'){
    $username = $data['username'];
    $examName = $data['examName'];
	$gradesID = $data['gradesID'];
	$score=$data['scores'];
	$comments=$data['comments'];
	$released=$data['released'];
	$testPointsDeducted = $data['deductedPointsPerEachTest'];
	$correctName = $data['deductedPointscorrectName'];
	$count = count($gradesID);

	for($i=0; $i < $count; $i++){
		$gradesID[$i] = (int) $gradesID[$i];
		$score[$i] = (int) $score[$i];
	}

	for($i=0; $i < $count; $i++){
		
		$query = "update `gradesTable` set `score`='$score[$i]',`comments`='$comments[$i]',`released`='$released',`pointsDeductedPerEachTest`='$testPointsDeducted[$i]',`pointsDeductedCorrectName`='$correctName[$i]' where `examName`='$examName' and `gradesID`='$gradesID[$i]' and `username`='$username'";
		//echo json_encode($query);

		$database->query($query) or die('There was an error saving the grades');
		
	}
	$ans =  'update successfully saved';
	

	
	echo json_encode($ans);	
}
if ($request == 'listGradedExams'){
		$query = "SELECT DISTINCT examName,username FROM gradesTable";
		$cursor = $database->query($query);
		if ($cursor->num_rows == 0)
			die('No exams found, try again later...');
		while ($row = $cursor->fetch_assoc()) {
			$exam[] = array("examName"=>$row['examName'],"username"=>$row['username']);
			
		}
		echo json_encode($exam);
}

if ($request == 'retrieve') {
	$ids = $data['questionID'];
    $result = array();
	$count = count($ids);

	for ($i = 0; $i < $count; $i++) {
		$query="SELECT * FROM questionTable WHERE questionID=".$ids[$i];
		$cursor = $database->query($query);
		while ($row = $cursor->fetch_assoc()) {
			$result[] = array('topic'=>$row['questTopic'], 'questText'=>$row['questionText'], 'questTest'=>$row['questTest']);
		}
	}

	echo json_encode($result);
}

mysqli_close($database);

?>