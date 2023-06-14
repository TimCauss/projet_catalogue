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
const closeTriggerElement = document.querySelectorAll(".closer");

addBtnElement.addEventListener("click", () => {
  modalAddElement.classList.add("active");
  addBtnElement.classList.add("onuse");
  pokeball.classList.add("pokeball--animation");
  overlayElement.classList.add("active");
});

closeTriggerElement.forEach((closer) => {
  closer.addEventListener("click", () => {
    closeModal();
  });
});

function closeModal() {
  modalAddElement.classList.remove("active");
  addBtnElement.classList.remove("onuse");
  overlayElement.classList.remove("active");
}
