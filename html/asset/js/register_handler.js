const form = document.forms["register"];
// const inputsToValidate = ["username", "password", "email", "gender"];
const submitButton = document.getElementById("submit");

form.addEventListener("input", () => {
  const usernameInput = document.forms["register"]["username"].value;
  const passwordInput = document.forms["register"]["password"].value;
  const emailInput = document.forms["register"]["email"].value;
  // const genderInput = document.forms["register"]["gender"].value;

  const errors = {};

  if(usernameInput.length < 2 || usernameInput.length > 18) {
    errors.username = "Username must be between 2 and 18 characters.";
  }
 
  if(passwordInput.length < 6 || passwordInput.length > 25) {
    errors.password = "Password must be between 6 and 25 characters.";
    console.log(passwordInput.value);
  }

  if(!/^\S+@\S+$/.test(emailInput)) {
    errors.email = "Email must be a valid email address.";
  }

  submitButton.disabled = Object.keys(errors).length > 0;

  document.getElementById("register").innerHTML = "";
  for (let key in errors) {
    const error = document.createElement("p");
    error.textContent = errors[key];
    document.getElementById("register").appendChild(error);
  }
});

function registerUser() {
  // TODO: pass valid input status into this function somehow
  // if (Object.keys(errors).length > 0) {
  //   alert("Please fix the errors before submitting.");
  //   return;
  // }

  var username = document.forms["register"]["username"].value;
  var password = document.forms["register"]["password"].value;
  var email = document.forms["register"]["email"].value;
  var gender = document.forms["register"]["gender"].value;

  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("register").innerHTML = this.responseText;
    }
  };

  // var captchaResponse = grecaptcha.getResponse();

  // if (captchaResponse.length == 0){
  //   return;
  // }

  var registerData =
      "username=" + encodeURIComponent(username) +
      "&password=" + encodeURIComponent(password) + 
      "&email=" + encodeURIComponent(email) + 
      "&gender=" + encodeURIComponent(gender);

  xhttp.open("POST", "/page/_script/register.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(registerData);
}