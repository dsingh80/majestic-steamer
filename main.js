
var navItems = document.querySelectorAll('.navlist a');
var navselector = document.querySelector('.navbar #navselector');
function isElementVisible(elem) {
    var elemTop = elem.getBoundingClientRect().top;
    var elemBottom = elem.getBoundingClientRect().bottom;

    var isVisible = (elemTop >= 0) && (elemBottom <= window.innerHeight);
    return isVisible;
}


/* MOBILE CHECK */
const MOBILE_THRESHOLD = 1200; // pixel value for when to transition to mobile
window.onresize = function(){
    var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    var height = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
    
    if(width > MOBILE_THRESHOLD)
        return;

    // LET'S GO MOBILE BABY
    console.log("GO MOBILE!");
};




/* NAVBAR CONTROLS */
var nav_inactive = false;
window.addEventListener('scroll', function(e){
	// NAVBAR STUFF

	// Check for navbar transparency
    if(window.pageYOffset > 100){
        if(nav_inactive==true)
            return;
        document.querySelector('.navbar').classList.add('inactive');
        nav_inactive = true;
    }
    else{
        if(nav_inactive==false)
            return;
        document.querySelector('.navbar').classList.remove('inactive');
        nav_inactive = false;
    }
});

window.addEventListener('scroll', function(ev){

	if(isElementVisible(document.querySelector('.services'))){
		const services = document.querySelectorAll('.service');
		const breakers = document.querySelectorAll('.service .breaker');
		services.forEach(service => service.classList.add('active'));
		breakers.forEach(breaker => breaker.classList.add('active'));
	}

	ev.target.removeEventListener(ev.type, arguments.callee);
});





/* SMOOTH SCROLLING */
var currentSelection = null;
function getYPos(element){
	var top = 0;
	do {
		top += element.offsetTop  || 0;
		element = element.offsetParent;
	} while(element);

	return top;
}
function getXPos(element){
	var left = 0;
	do {
		left += element.offsetLeft  || 0;
		element = element.offsetParent;
	} while(element);

	return left;
}

function lerp(elem, targetX, targetY) {
  elem.style.left = elem.offsetLeft + (targetX - elem.offsetLeft)*0.2;
  elem.style.top = elem.offsetTop + (targetY - elem.offsetTop)*0.2;
}

function SmoothScrollTo(targetY, duration) {
	if(targetY >= 250){
		targetY -= 250;
	}
	const difference = targetY - window.scrollY;
	const speed = Math.floor(difference/duration * 10);
	var i;
	
	const timeoutID = setInterval(function(){
		window.scrollTo(0, window.scrollY+speed)
	}, 10);
	
	setTimeout(function(){
		clearInterval(timeoutID);
	}, duration);
	
}

function updateNavBar() {
	if(this.firstChild == currentSelection)
		return;
	
	currentSelection.classList.remove('selected');
	currentSelection = this.firstChild;
	//navselector.style.left = getXPos(currentSelection);
	//navselector.style.top = getYPos(currentSelection);
	navselector.style.width = currentSelection.clientWidth;
	
	SmoothScrollTo(getYPos(document.querySelector(`#${currentSelection.textContent}`)), 300);
}

function updateNavBarManual(elem){
	if(elem.firstChild == currentSelection)
		return;
	currentSelection.classList.remove('selected');
	currentSelection = elem.firstChild;
	//navselector.style.left = getXPos(currentSelection);
	//navselector.style.top = getYPos(currentSelection);
	navselector.style.width = currentSelection.clientWidth;
}

function verifyNavBarSelection(){
	// Make sure visible nav section is selected in navbar
	navItems.forEach(function(nav){
		if(isElementVisible(document.querySelector(`#${nav.firstChild.textContent}`)) == true){
			updateNavBarManual(nav);
		}
	});
}

function updateNavselector(){
	lerp(navselector, getXPos(currentSelection), getYPos(currentSelection));
	if(Math.abs(navselector.offsetLeft - getXPos(currentSelection)) < 5)
		currentSelection.classList.add('selected');

	window.requestAnimationFrame(updateNavselector);
}

function addListeners() {
	navItems = document.querySelectorAll('.navlist a');
	navselector = document.querySelector('.navbar #navselector');
	currentSelection = navItems[0].firstChild;

	navItems.forEach(navItem => navItem.addEventListener('click', updateNavBar));
	document.querySelector('#contactForm').addEventListener('submit', handleForm);

	setInterval(verifyNavBarSelection, 400);
	window.requestAnimationFrame(updateNavselector);
	navselector.classList.add('active');
};

function sendMail(email){
	
}

function handleForm(ev){
	ev.preventDefault();
	const form = ev.currentTarget;

	const MessageInfo = {
		name: form.name.value,
		email: form.email.value,
		message: form.querySelector('textarea').value,
	}

	let emailString = "mailto:majesticsteamers@gmail.com"
	emailString += `?subject=Contact%20Request%20from%20${MessageInfo.name.split("%20")}`
	emailString += `&bcc=${MessageInfo.email}`
	emailString += `&body=${MessageInfo.message.split("$20")}`
	window.location.href = emailString//`mailto:majesticsteamer@gmail.com?subject=Contact%20Request%20from%20${MessageInfo.name.split("%20")}&bcc=${MessageInfo.email}&body=${MessageInfo.message.split("$20")}`

	form.reset();
}

