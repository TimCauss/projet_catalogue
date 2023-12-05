const navLogbtnElem = document.querySelector(".ni-login");
const loginBtnElem = document.querySelector(".login-buttons");

navLogbtnElem.addEventListener("click", () => {
  loginBtnElem.classList.toggle("login-buttons-show");
});