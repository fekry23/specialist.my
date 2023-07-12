// Get the userType parameter from the URL
const urlParams = new URLSearchParams(window.location.search);
const userType = window.location.pathname.split('/')[2]; // "/register/userType"
// console.log(userType);
// Call the display_SignupForm function with the userType parameter
display_SignupForm(userType);

function display_SignupForm(typeOfUser) {
    const header = document.getElementById("signup-header");
    const emailInput = document.getElementsByName('email')[0];
    const userTypeInput = document.getElementById("user-type");
    const form = document.getElementById("user-signup-form");

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


const backButton = document.getElementById("back-button");
backButton.addEventListener("click", function () {
    window.history.back();
})