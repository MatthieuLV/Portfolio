let root = document.documentElement;
let body = document.querySelector("body");

let changeSecondary = document.querySelector("#change-secondary");

let changeMode = document.querySelector("#change-mode");

let secondaryColors = getComputedStyle(document.body).getPropertyValue('--secondary-colors').split(",").length - 1;

let textColors = getComputedStyle(document.body).getPropertyValue('--text-colors').split(",").length - 1;

let backgroundColors = getComputedStyle(document.body).getPropertyValue('--background-colors').split(",").length - 1;

let shadowTopColors = getComputedStyle(document.body).getPropertyValue('--shadow-top-colors').split(",").length - 1;

let shadowBottomColors = getComputedStyle(document.body).getPropertyValue('--shadow-bottom-colors').split(",").length - 1;


let indexSecondary = checkIndexSecondary();
let indexMode = checkIndexMode();

body.setAttribute('secondary-color', indexSecondary);
body.setAttribute('text-color', indexMode);
body.setAttribute('background-color', indexMode);
body.setAttribute('shadow-top-color', indexMode);
body.setAttribute('shadow-bottom-color', indexMode);

changeSecondary.addEventListener("click", function(){
indexSecondary = (indexSecondary++ >= secondaryColors) ? 0 : indexSecondary++;
	body.setAttribute('secondary-color', indexSecondary);
	setCookie('indexSecondary',indexSecondary,365);
	console.log(document.cookie);

})

changeMode.addEventListener("click", function(){
 indexMode = (indexMode++ >= textColors) ? 0 : indexMode++;
	body.setAttribute('text-color', indexMode);
	body.setAttribute('background-color', indexMode);
	body.setAttribute('shadow-top-color', indexMode);
	body.setAttribute('shadow-bottom-color', indexMode);

	setCookie('indexMode',indexMode,365);

	console.log(document.cookie);

  
})

function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires="+ d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

function getCookie(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for(var i = 0; i <ca.length; i++) {
	  var c = ca[i];
	  while (c.charAt(0) == ' ') {
		c = c.substring(1);
	  }
	  if (c.indexOf(name) == 0) {
		return c.substring(name.length, c.length);
	  }
	}
	return "";
}

function checkIndexSecondary() {
	var indexSecondary = getCookie("indexSecondary");
	if ( indexSecondary != "") {
		console.log("indexSecondary secondary :"+getCookie("indexSecondary"))
		return indexSecondary;
	} else {
		setCookie("indexSecondary", 0, 365);
		console.log("indexSecondary secondary :"+getCookie("indexSecondary"))
		return 0;
	}
}

function checkIndexMode() {
	var indexMode = getCookie("indexMode");
	if ( indexMode != "") {
		return indexMode;
	} else {
		setCookie("indexMode", 0, 365);
		return 0;
	}
}




