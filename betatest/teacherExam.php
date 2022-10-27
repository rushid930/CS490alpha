<?php
	define('MAGICNUMBER', true);
	include 'restrict.php';
?>
<div id="ExamMain">
	<form id="SubmitExamForm">
		<label for="Exam Name"><strong>Exam Name </strong></label>
		<input type="text" name="Exam Name" placeholder="Exam Name" id="examName"/>
		<input type="submit" value="Create Exam"/>
	</form>
	<h3 id="response"></h3>
	<h2 id="examheader"></h2>
	<label for="Filters"><strong>Question Filters </strong></label>
	<select name="FilterTopic" id="ftopic">
		<option value="All">All</option>
        <option value="Lists">Lists</option>
        <option value="ForLoops">For Loops</option>
        <option value="WhileLoops">While Loops</option>
        <option value="If">If Statements</option>
        <option value="Variables">Variables</option>
	</select>
	<select name="FilterDifficulty" id="fdifficulty">
		<option value="All">All</option>
		<option value="Easy">Easy</option>
		<option value="Medium">Medium</option>
		<option value="Hard">Hard</option>
	</select>
	<div id="split">
		<div id="QuestionList">
		</div>
		<div id="SelectedQuestions">
			<p> Selected Questions .. </p>
		</div>
	</div>
</div>