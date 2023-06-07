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

/* VERIFICATION DES MOTS DE PASSE */
const pass1 = document.getElementById("pass");
const pass2 = document.getElementById("pass2");
const subButton = document.getElementById("submitForm");

window.addEventListener("keyup", () => {
  if (pass1.value.length >= 5 && pass1.value == pass2.value) {
    subButton.removeAttribute("disabled");
  } else {
    subButton.setAttribute("disabled", "");
  }
});

/* CHANGEMENT DES FORMULAIRES LOGIN/REGISTER */

const btnChangeToLogin = document.querySelector(".form-change");
const registerElem = document.querySelector(".register-form-ctn");

btnChangeToLogin.addEventListener("click", () => {
  console.log("click");
  registerElem.classList.add("register-hidden");
});
