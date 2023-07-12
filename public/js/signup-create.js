/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/signup/signup-create.js ***!
  \**********************************************/
// Get the userType parameter from the URL
var urlParams = new URLSearchParams(window.location.search);
var userType = window.location.pathname.split('/')[2]; // "/register/userType"
console.log(userType);
// Call the display_SignupForm function with the userType parameter
display_SignupForm(userType);
function display_SignupForm(typeOfUser) {
  if (typeOfUser === "employer") {
    document.getElementById("signup-header").innerText = "Sign up to hire specialist";
    document.getElementsByName('email')[0].placeholder = 'Company email address';
  } else if (typeOfUser === "trainer") {
    document.getElementById("signup-header").innerText = "Sign up to find work you love";
    document.getElementsByName('email')[0].placeholder = 'Email address';
  }
}
var backButton = document.getElementById("back-button");
backButton.addEventListener("click", function () {
  window.history.back();
});
/******/ })()
;