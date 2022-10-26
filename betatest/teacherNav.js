hashevent();

window.addEventListener("hashchange", hashevent);

function hashevent(){
	let hash = (location.hash).substr(1);
	let hashes = { home: 'https://afsaccess4.njit.edu/~rd448/teacherLanding',
					question: 'https://afsaccess4.njit.edu/~rd448/teacherQuestion',
					exam: 'https://afsaccess4.njit.edu/~rd448/teacherExam',
					completed: 'https://afsaccess4.njit.edu/~rd448/teacherCompleted',
					grade: 'https://afsaccess4.njit.edu/~rd448/teacherGrade' };

	if(!hash){
		hash = 'home';
    }
    else if(hash.substr(0,5) == 'grade'){
        hash = 'grade';
    }
	
	hash = hashes[hash];

	ajaxGet(hash, morph);
}

function ajaxGet(page, callback){
	let resp;
	let xhr = new XMLHttpRequest();

	xhr.open("GET", page + '.php', true);

	xhr.onload = function(){
		if(xhr.status == 200){
			resp = this.responseText;
			callback(resp, page + '.js');
		}
	}

	xhr.send(null);
}

function morph(content, script){
	const divMain = document.getElementById("main");
    const divSubscript = document.getElementById("subscript");

    while (divSubscript.firstChild){
        divSubscript.removeChild(divSubscript.lastChild);
    }

	divMain.innerHTML = content;
        
    let subscript = document.createElement('script');
    subscript.setAttribute('src', script);
    divSubscript.appendChild(subscript); 
}