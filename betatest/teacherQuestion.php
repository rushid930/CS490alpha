<?php
	define('MAGICNUMBER', true);
	include 'restrict.php';
?>
<div id="QuestionMain">
    <h2>New Question</h2>
    <form id="QuestionForm">
        <label for="Topic"><strong>Topic </strong></label>
        <select required name="Topic" id="topic">
            <option value="Lists">Lists</option>
            <option value="ForLoops">For Loops</option>
            <option value="WhileLoops">While Loops</option>
            <option value="If">If Statements</option>
            <option value="Variables">Variables</option>
        </select><br />

        <label for="Difficulty"><strong>Difficulty </strong></label>
        <select required name="Difficulty" id="difficulty">
            <option value="Easy">Easy</option>
            <option value="Medium">Medium</option>
            <option value="Hard">Hard</option>
        </select><br /><br />

	    <label for="VQuestion"><br><strong>Question </strong></label><br />
	    <p>Write a function named <input type="text" placeholder="Name" id="fname" />.<br />Given <input type="text" placeholder="Arguments" id="fargs" />, the function should <input type="text" placeholder="Do Something" id="fbody" /><br /> and <select required name="Output Type" id="fotype"><option value="return">return</option><option value="print">print</option></select> <input type="text" placeholder="Output" id="foutput" />.</p><br />
	    
        <label for="Test Cases"><strong>Test Cases </strong></label><br /><br />
	    <input type="text" placeholder="Inputs" id="testinput1" name="TestIn" /><input type="text" placeholder="Expected Output" id="testoutput1" name="TestOut" /><br />
	    <input type="text" placeholder="Inputs" id="testinput2" name="TestIn"/><input type="text" placeholder="Expected Output" id="testoutput2" name="TestOut" /><br />
        <br />
        
        <input type="submit" value="Create Question"/>
    </form>
    <h3 id="response"></h3>
</div>