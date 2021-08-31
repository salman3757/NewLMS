if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}


var search = document.getElementById('search');
search.addEventListener('keyup', displayMatches);
let courses = [];

window.onload = function(){
    fetch('http://127.0.0.1:8000/api/courses').then(function (response) {
	//The API call was successful!
	return response.json();
}).then(function (data) {
	//This is the JSON from our response
	// console.log(data);
    courses=data;
}).catch(function (err) {
	//There was an error
	console.warn('Something went wrong.', err);
});
}

function displayMatches(){
    if(this.value.trim().length !==0 ){
        const arr = courses.filter((x) => {
            return x.name.toLowerCase().includes(this.value.toLowerCase()) || 
            x.description.toLowerCase().includes(this.value.toLowerCase());
        })
        console.log(arr);
    }
}



// async function myFetch(){
//     const response = await fetch('http://127.0.0.1:8000/api/courses');
//     const courses = await response.json();

//     return courses;
// }

// myFetch().then((courses) => {
//     var all_courses = courses;
//     console.log(all_courses);
// }).catch(e => console.log(e));

