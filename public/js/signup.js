/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/signup.js ***!
  \********************************/
//Client button is selected
function selectedButton_client() {
  //Set css property
  document.getElementById("client").style.border = "3px solid #89CFF0";
  document.getElementById("client").style.boxShadow = "0 5px #666";
  document.getElementById("client").style.transform = "translateY(4px)";
  //Reset css property
  document.getElementById("freelancer").style.removeProperty("transform");
  document.getElementById("freelancer").style.border = "3px solid gray";
  document.getElementById("freelancer").style.boxShadow = "0 4px #999";
  setButton("Client");
}
//Freelancer button is selected
function selectedButton_freelancer() {
  //Set css property
  document.getElementById("client").style.removeProperty("transform");
  document.getElementById("client").style.border = "3px solid gray";
  document.getElementById("client").style.boxShadow = "0 4px #999";
  //Reset css property
  document.getElementById("freelancer").style.border = "3px solid #89CFF0";
  document.getElementById("freelancer").style.boxShadow = "0 5px #666";
  document.getElementById("freelancer").style.transform = "translateY(4px)";
  setButton("Freelancer");
}

//Set button css property
function setButton(typeOfUser) {
  document.getElementById("create-account").disabled = false;
  document.getElementById("create-account").style.backgroundColor = "#89CFF0";
  document.getElementById("create-account").style.color = "white";
  document.getElementById("create-account").style.border = "3px solid #89CFF0";
  document.getElementById("create-account").style.cursor = "pointer";
  document.getElementById("create-account").textContent = "Apply as " + typeOfUser;
}

//To set which button is clicked
var clientClicked = false;
var freelancerClicked = false;
function setUserVariable(user) {
  if (user == "client") {
    clientClicked = true;
    freelancerClicked = false;
  } else if (user == "freelancer") {
    freelancerClicked = true;
    clientClicked = false;
  }
}

//To display user sign up form based on their selection
function display_SignupForm() {
  //style="display:none;"
  document.getElementById("choose-method-container").style.display = "none";
  document.getElementById("client-signup-form").style.display = "block";
  if (clientClicked) {
    document.getElementById("signup-header").innerText = "Sign up to hire specialist";
    document.getElementsByName('email')[0].placeholder = 'Company email address';
  } else if (freelancerClicked) {
    document.getElementById("signup-header").innerText = "Sign up to find work you love";
    document.getElementsByName('email')[0].placeholder = 'Email address';
  }
}
function backClicked() {
  document.getElementById("choose-method-container").style.display = "flex";
  document.getElementById("client-signup-form").style.display = "none";
}
/******/ })()
;