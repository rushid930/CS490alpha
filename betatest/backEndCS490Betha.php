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

if ($request == 'CreateQuestion'){
    $topic = $data['topic'];
	$tests = $data['testcases'];
    $difficulty = $data['difficulty'];
    $quest = $data['questiontext'];
    
	//Creating the question
	$query = "SELECT * FROM questionTable WHERE question='$quest'";
	$cursor = $db->query($query);
	if ($cursor->num_rows == 0) {
		$query = "INSERT INTO questionTable (questTopic, questTest, questDifficulty, question) VALUES ('$topic','$tests', '$difficulty','$quest');";
		$db->query($query) or die('There was an error saving your question');
		$ans =  'Question successfully saved with id '.$db->insert_id;
		//echo json_encode($ans);
	}
	else
		$ans = 'Question already saved';
	//Returns the JSON representation of $ans
	echo json_encode($ans);
	
}

if ($request == 'GetQuestions'){//list questions 
	$query="SELECT * from questionTable";
	$cursor = $db->query($query);
	while ($row = $cursor->fetch_array()) {
		$questionID = $row[0];
		$questionTopic = $row[1];
        $questionTest = $row[2];
		$questionDifficulty = $row[3];
		$question=$row[4];
		$ans[] = array(
			"questID" => $questionID,
			"topic" => $questionTopic,
			"testcases" => $questionTest,
			"difficulty" => $questionDifficulty,
			"questiontext" => $question);
	}
	echo json_encode($ans);
}

mysqli_close($database);

?>