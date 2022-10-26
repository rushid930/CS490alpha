document.getElementById("LoginForm").addEventListener("submit", login);

function login(e){

	e.preventDefault();
	
	const SERVER = 'https://afsaccess4.njit.edu/~rd448/frontEndCS490.php';
	const STUDENT_PAGE = 'https://afsaccess4.njit.edu/~rd448/student.php';
	const TEACHER_PAGE = 'https://afsaccess4.njit.edu/~rd448/teacherNav.php'; //test test test

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
            //console.log(resp);

			if(resp == "Teacher")
				window.location.replace(TEACHER_PAGE);
			
			else if (resp == "Student")
				window.location.replace(STUDENT_PAGE);

			else if (resp == "backNoexist" || resp == "backNo")
				elem.innerHTML = "Login Failed...";
		}
	}

    xhr.send(post_params);

}