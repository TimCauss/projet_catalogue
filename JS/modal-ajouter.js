// POKEBALL SECTION :

const pokeball = document.querySelector(".pokeball");
const pokeballbutton = document.querySelector(".pokeball__button");

pokeball.addEventListener("mouseover", () => {
  pokeball.classList.remove("pokeball--animation");
});

// MODAL SECTION :

const addBtnElement = document.querySelector(".trg-btn");
const modalAddElement = document.querySelector(".form-add-container");
const overlayElement = document.querySelector(".overlay");

addBtnElement.addEventListener("click", () => {
  modalAddElement.classList.toggle("active");
  addBtnElement.classList.toggle("onuse");
  pokeball.classList.add("pokeball--animation");
  overlayElement.classList.toggle("active");
});

overlayElement.addEventListener("click", () => {
  modalAddElement.classList.remove("active");
  addBtnElement.classList.remove("onuse");
  overlayElement.classList.remove("active");
});

