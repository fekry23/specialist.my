/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************************!*\
  !*** ./resources/js/signup/signup-index.js ***!
  \*********************************************/
var employerButton = document.getElementById("employer");
var trainerButton = document.getElementById("trainer");
var createAccountButton = document.getElementById('create-account');
var backButton = document.getElementById("back-button");
var userTypeHiddenInput = document.getElementById('user-type'); //For form to decide which user is selected
var userType = null;
employerButton.addEventListener("click", function () {
  userType = "employer";
  createAccountButton.disabled = false;
  createAccountButton.dataset.userType = 'employer';
  selectedButton(userType);
  // userTypeHiddenInput.value = userType;
});

trainerButton.addEventListener("click", function () {
  userType = "trainer";
  createAccountButton.disabled = false;
  createAccountButton.dataset.userType = 'trainer';
  selectedButton(userType);
  // userTypeHiddenInput.value = userType;
});

createAccountButton.addEventListener('click', function () {
  var userType = createAccountButton.dataset.userType;
  window.location.href = "/register/".concat(userType);
});

//Button is selected / Set css property
function selectedButton(typeOfUser) {
  if (typeOfUser === "employer") {
    document.getElementById(typeOfUser).style.border = "3px solid #89CFF0";
    document.getElementById(typeOfUser).style.boxShadow = "0 5px #666";
    document.getElementById(typeOfUser).style.transform = "translateY(4px)";
    unsetButton(typeOfUser, "trainer");
  }
  if (typeOfUser === "trainer") {
    document.getElementById(typeOfUser).style.border = "3px solid #89CFF0";
    document.getElementById(typeOfUser).style.boxShadow = "0 5px #666";
    document.getElementById(typeOfUser).style.transform = "translateY(4px)";
    unsetButton(typeOfUser, "employer");
  }
  setCreateButton(typeOfUser);
}

//Button is deselected / Reset css property 
function unsetButton(selectedUser, resetUser) {
  if (selectedUser === "employer") {
    document.getElementById(resetUser).style.removeProperty("transform");
    document.getElementById(resetUser).style.border = "3px solid gray";
    document.getElementById(resetUser).style.boxShadow = "0 4px #999";
  }
  if (selectedUser === "trainer") {
    document.getElementById(resetUser).style.removeProperty("transform");
    document.getElementById(resetUser).style.border = "3px solid gray";
    document.getElementById(resetUser).style.boxShadow = "0 4px #999";
  }
}

//Set button css property
function setCreateButton(typeOfUser) {
  document.getElementById("create-account").disabled = false;
  document.getElementById("create-account").style.backgroundColor = "#89CFF0";
  document.getElementById("create-account").style.color = "white";
  document.getElementById("create-account").style.border = "3px solid #89CFF0";
  document.getElementById("create-account").style.cursor = "pointer";
  document.getElementById("create-account").textContent = "Apply as " + typeOfUser;
}
/******/ })()
;