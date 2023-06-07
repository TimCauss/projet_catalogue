/* VALIDATION DES CHAMPS DU FORMULAIRE */
(() => {
  "use strict";

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll(".needs-validation");

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms).forEach((form) => {
    form.addEventListener(
      "submit",
      (event) => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add("was-validated");
      },
      false
    );
  });
})();

/* VERIFICATIONs FORMULAIRES*/
const pass1 = document.getElementById("pass");
const pass2 = document.getElementById("pass2");
const subButton = document.getElementById("submitForm");
const loginInputElem = document.getElementById("login-email");
const lPassInputElem = document.getElementById("login-pass");
const subLogBtnElem = document.getElementById("submitLogin");

function formVerif() {
  if (pass1.value.length >= 5 && pass1.value == pass2.value) {
    subButton.removeAttribute("disabled");
  } else {
    subButton.setAttribute("disabled", "");
  }
  loginInputElem.value && lPassInputElem.value
    ? subLogBtnElem.removeAttribute("disabled")
    : subLogBtnElem.setAttribute("disabled", "");
}

window.addEventListener("keyup", formVerif);

/* CHANGEMENT DES FORMULAIRES LOGIN/REGISTER */

const btnChangeToLogin = document.querySelector(".form-change");
const btnChangeToReg = document.querySelector(".form-change2");
const registerElem = document.querySelector(".register-form-ctn");
const loginElem = document.querySelector(".login-form-ctn");

btnChangeToLogin.addEventListener("click", () => {
  registerElem.classList.add("register-hidden");
  loginElem.classList.remove("hidden-scale");
  setTimeout(() => {
    registerElem.classList.add("hidden-scale");
    registerElem.classList.remove("register-hidden");
  }, "175");
});

btnChangeToReg.addEventListener("click", () => {
  loginElem.classList.add("login-hidden");
  registerElem.classList.remove("hidden-scale");
  setTimeout(() => {
    loginElem.classList.add("hidden-scale");
    loginElem.classList.remove("login-hidden");
  }, "175");
});
