/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/signup/signup-create.js ***!
  \**********************************************/
// Get the userType parameter from the URL
var urlParams = new URLSearchParams(window.location.search);
var userType = window.location.pathname.split('/')[2]; // "/register/userType"
// console.log(userType);
// Call the display_SignupForm function with the userType parameter
display_SignupForm(userType);
function display_SignupForm(typeOfUser) {
  var header = document.getElementById("signup-header");
  var emailInput = document.getElementsByName('email')[0];
  var userTypeInput = document.getElementById("user-type");
  var form = document.getElementById("user-signup-form");
  if (typeOfUser === "employer") {
    header.innerText = "Sign up to hire specialist";
    emailInput.placeholder = 'Company email address';
  } else if (typeOfUser === "trainer") {
    header.innerText = "Sign up to find work you love";
    emailInput.placeholder = 'Email address';
  }
  userTypeInput.value = typeOfUser;
  // form.setAttribute('action', '/register/' + typeOfUser + '/store');
  // console.log('/register/' + typeOfUser + '/store');
  // form.action = '/register/' + typeOfUser + '/store';
}

var backButton = document.getElementById("back-button");
backButton.addEventListener("click", function () {
  window.history.back();
});
/******/ })()
;