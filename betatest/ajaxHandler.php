<?php
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    //echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
?>
<?php
	define('MAGICNUMBER', true);
	include 'restrict.php';

    $URL = 'https://web.njit.edu/~rd448/middleCS490Beta.php'; //andrew

	$reqtype = $_POST['RequestType'];

	$post_params = http_build_query(array('RequestType' => $reqtype, 'data' => ''));

	switch($reqtype){
		case 'CreateQuestion':
			$topic = $_POST['topic'];
			$difficulty = $_POST['difficulty'];
			$questiontext = $_POST['questionText'];
			$testcases = $_POST['testCases'];
			$post_params = http_build_query(array('RequestType' => $reqtype, 'data' => array('topic' => $topic, 'difficulty' => $difficulty, 'questionText' => $questiontext, 'testCases' => $testcases)));
			break;

		case 'createExam':
			$name = $_POST['examname'];
			$ids = $_POST['ids'];
			$points = $_POST['points'];
			$post_params = http_build_query(array('RequestType' => $reqtype, 'data' => array('exaName' => $name, 'questionsid' => explode(",",$ids), 'questPoint' => explode(",",$points))));
			break;

		case 'showExam':
			$name = $_POST['examname'];
			$post_params = http_build_query(array('RequestType' => $reqtype, 'data' => array('exaName' => $name)));
			break;

		case 'submitExam':
			$name = $_POST['examname'];
			$ids = $_POST['ids'];
			$points = $_POST['points'];
			$answers = $_POST['answers'];
			$user = $_SESSION['user'];
			$post_params = http_build_query(array('RequestType' => $reqtype, 'data' => array('exaName' => $name, 'ucid' => $user, 'questionsid' => explode(",",$ids), 'answers' => explode("HACKMAGICK",$answers), 'points' => explode(",",$points))));
			break;

		case 'showGradedExam':
			$name = $_POST['examname'];
			if ($_SESSION['teacher'])
				$user = $_POST['user'];
			else if ($_SESSION['student'])
				$user = $_SESSION['user'];
			$post_params = http_build_query(array('RequestType' => $reqtype, 'data' => array('exaName' => $name, 'ucid' => $user)));
			break;
		
		case 'modifyGradedExam':
			$name = $_POST['examname'];
			$user = $_POST['user'];
			$released = $_POST['released'];
			$ids = $_POST['ids'];
			$scores = $_POST['scores'];
			$comments = $_POST['comments'];
			$nameDs = $_POST['nameDs'];
			$tcDs = $_POST['tcDs'];
			$shittytcDs = explode(",",$tcDs);
			$shittytcDs = str_replace("...", ", ", $shittytcDs);
			$post_params = http_build_query(array('RequestType' => $reqtype, 'data' => array('exaName' => $name, 'ucid' => $user, 'gradesID' => explode(",",$ids), 'scores' => explode(",",$scores), 'comments' => explode(",",$comments), 'released' => $released, 'deductedPointscorrectName' => explode(",",$nameDs), 'deductedPointsPerEachTest' => $shittytcDs)));
			break;

		case 'listGradedExamsStudent':
			$user = $_SESSION['user'];
			$post_params = http_build_query(array('RequestType' => $reqtype, 'data' => array('ucid' => $user)));
			break;

		case 'listExams':
			$user = $_SESSION['user'];
			$post_params = http_build_query(array('RequestType' => $reqtype, 'data' => array('ucid' => $user)));
			break;

		default:
			//GetQuestions
			//listGradedExams
			break;
	}

	//debug_to_console($post_params);
	//debug_to_console($URL);
	$resp = handoff($post_params, $URL);
	//debug_to_console($resp);
	echo $resp;

	function handoff($post_params, $URL){
		$ch = curl_init();
		$options = array(CURLOPT_URL => $URL,
			    CURLOPT_HTTPHEADER => array('Content-type:application/x-www-form-urlencoded'),
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_POST => TRUE,
				CURLOPT_POSTFIELDS => $post_params);
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
?>