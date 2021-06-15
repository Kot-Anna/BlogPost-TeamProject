const invalidFeedback = document.querySelector(".invalid-feedback");
const ok = document.querySelector(".ok");
const notOk = document.querySelector(".not-ok");
const namee = document.getElementById("name");
const username = document.getElementById("username");
const email = document.getElementById("email");
const phone = document.getElementById("phone");
const password = document.getElementById("password");
const password2 = document.getElementById("password2");

namee.addEventListener("keyup", validateName);
username.addEventListener("keyup", validateUsername);
email.addEventListener("keyup", validateEmail);
phone.addEventListener("keyup", validatePhone);
password.addEventListener("keyup", validatePassword);
password2.addEventListener("keyup", validatePassword2);

function validateName() {
  const reg = /^[a-zA-Z ]+$/;

  if (namee.value === "") {
    fieldEmpty(namee);
  } else {
    if (!reg.test(namee.value)) {
      turnRed(namee);
    } else {
      turnGreen(namee);
    }
  }
}

function validateUsername() {
  const reg = /^[a-zA-Z0-9-_.]{3,20}$/;

  if (username.value === "") {
    fieldEmpty(username);
  } else {
    if (!reg.test(username.value)) {
      turnRed(username);
    } else {
      turnGreen(username);
    }
  }
}

function validateEmail() {
  const reg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

  if (email.value === "") {
    fieldEmpty(email);
  } else {
    if (!reg.test(email.value)) {
      turnRed(email);
    } else {
      turnGreen(email);
    }
  }
}

function validatePhone() {
  const reg = /^\+?[\d]{2,3}[-. ]?\d{2,3}[-. ]?\d{2,3}[-. ]?\d{1,4}$/;

  if (phone.value === "") {
    fieldEmpty(phone);
  } else {
    if (!reg.test(phone.value)) {
      turnRed(phone);
    } else {
      turnGreen(phone);
    }
  }
}

function validatePassword() {
  const reg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/;
  const reg2 = /^(?=.*[a-z])/;
  const reg3 = /^(?=.*[A-Z])/;
  const reg4 = /^(?=.*[0-9])/;
  const reg5 = /^(?=.{8,})/;

  if (password.value === "") {
    fieldEmpty(password);
  } else {
    if (!reg.test(password.value)) {
      turnRed(password);
      if (reg2.test(password.value)) {
        document.querySelector(".lowerCase").style.color = "#53a651";
        document.querySelector(".lowerCase").classList.add("tick");
      } else {
        document.querySelector(".lowerCase").style.color = "#ff6c6c";
        document.querySelector(".lowerCase").classList.remove("tick");
      }

      if (reg3.test(password.value)) {
        document.querySelector(".upperCase").style.color = "#53a651";
        document.querySelector(".upperCase").classList.add("tick");
      } else {
        document.querySelector(".upperCase").style.color = "#ff6c6c";
        document.querySelector(".upperCase").classList.remove("tick");
      }

      if (reg4.test(password.value)) {
        document.querySelector(".numeric").style.color = "#53a651";
        document.querySelector(".numeric").classList.add("tick");
      } else {
        document.querySelector(".numeric").style.color = "#ff6c6c";
        document.querySelector(".numeric").classList.remove("tick");
      }

      if (reg5.test(password.value)) {
        document.querySelector(".eightchar").style.color = "#53a651";
        document.querySelector(".eightchar").classList.add("tick");
      } else {
        document.querySelector(".eightchar").style.color = "#ff6c6c";
        document.querySelector(".eightchar").classList.remove("tick");
      }
    } else {
      turnGreen(password);
    }
  }
}
function validatePassword2() {
  const pass1 = password.value;
  const pass2 = password2.value;

  if (password2.value === "") {
    fieldEmpty(password2);
  } else {
    if (pass1 !== pass2) {
      turnRed(password2);
    } else {
      turnGreen(password2);
    }
  }
}

function turnRed(x) {
  x.nextElementSibling.style.display = "block";
  x.previousElementSibling.previousElementSibling.style.display = "block";
  x.previousElementSibling.style.display = "none";
  x.style.border = "2px solid #ff6c6c";
}

function turnGreen(x) {
  x.nextElementSibling.style.display = "none";
  x.previousElementSibling.previousElementSibling.style.display = "none";
  x.previousElementSibling.style.display = "block";
  x.style.border = "2px solid #53a651";
}

function fieldEmpty(x) {
  x.nextElementSibling.style.display = "none";
  x.previousElementSibling.previousElementSibling.style.display = "none";
  x.previousElementSibling.style.display = "none";
  x.style.border = "1px solid #ddd";
}
