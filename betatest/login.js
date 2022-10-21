document.getElementById("LoginForm").addEventListener("submit", login);

function login(e){

	e.preventDefault();
	
	const SERVER = 'https://afsaccess4.njit.edu/~rd448/frontEndCS490.php';
	const STUDENT_PAGE = 'https://afsaccess4.njit.edu/~rd448/student.php';
	const TEACHER_PAGE = 'https://afsaccess4.njit.edu/~rd448/teacher.php';
    console.log(SERVER);

	let username = document.getElementById("username").value;
	let password = document.getElementById("password").value;
	
	let post_params = "&username=" + username + "&password=" + password;
    console.log(post_params);
	
	let xhr = new XMLHttpRequest();
	xhr.open("POST", SERVER, true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    //xhr.setRequestHeader('Access-Control-Allow-Origin', '*');
    
	xhr.onload = function(){
		if (xhr.status == 200){
			let elem = document.getElementById("response");
            console.log(elem);
            console.log(this.responseText);
			let resp = JSON.parse(this.responseText);
            console.log(resp);

			if(resp == "Teacher")
				window.location.replace(TEACHER_PAGE);
			
			else if (resp == "Student")
				window.location.replace(STUDENT_PAGE);

			else if (resp == "backNoexist" || resp == "backNo")
				elem.innerHTML = "Login Failed...";

		}
	}
    /*
    xhr.onreadystatechange = function(){
		if(this.readyState === 4 && this.status===200){
			var ajaxDisplay = document.getElementById('response');
			var res=xhr.responseText;
			
			var stu_page="student.php";
			var inst_page="teacher.php";
			var data=JSON.parse(res);
			if (data['type']=="student") window.location.replace(stu_page);
			else if(data['type']=="teacher") window.location.replace(inst_page);
			else ajaxDisplay.innerHTML = "<h3><center>Login Failed</center></h3>";
		}
	}
    */

    xhr.send(post_params);

}