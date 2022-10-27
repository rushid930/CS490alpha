ajaxList(listExams);

function ajaxList(callback){

        const SERVER = 'ajaxHandler.php';
        const post_params = "RequestType=listGradedExams";

        let xhr = new XMLHttpRequest();
        xhr.open("POST", SERVER, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function(){
                if (xhr.status == 200){
                	if (this.responseText == "No exams found, try again later..."){
                        	document.getElementById("CompletedList").innerHTML = "No exams found...";
                        	return;
                }

                        let resp = JSON.parse(this.responseText);
                        callback(resp);
                }
        }
        
        xhr.send(post_params);
}

function listExams(exams){
	const divList = document.getElementById("CompletedList");

	for(let exam in exams){
		let li = document.createElement("li");
		let a = document.createElement("a");

		a.setAttribute('href', '#grade?exam=' + exams[exam]['examName'] + '?user=' + exams[exam]['username']);
		a.innerHTML = exams[exam]['examName'] + ' (STUDENT: <strong>' + exams[exam]['username'] + '</strong>)';
		
		li.setAttribute('id', 'examName');
		li.appendChild(a);
		li.innerHTML += '<br />';
		
		divList.appendChild(li);
	}
}