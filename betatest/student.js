hashevent();

window.addEventListener("hashchange", hashevent);

function hashevent(){

	let hash = (location.hash).substr(1);
	let hashes = { home: 'studentHome',
		       exam: 'studentExam',
		       review: 'studentReview',
		       take: 'studentTake',
		       view: 'studentView' };

	if(!hash)
		hash = 'home';
	
	else if(hash.substr(0,4) == 'take')
		hash = 'take';
	
	else if(hash.substr(0,4) == 'view')
		hash = 'view';
	
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

        while (divSubscript.firstChild)
            divSubscript.removeChild(divSubscript.lastChild);

	divMain.innerHTML = content;
        
        let subscript = document.createElement('script');
        subscript.setAttribute('src', script);
        divSubscript.appendChild(subscript);
        
}