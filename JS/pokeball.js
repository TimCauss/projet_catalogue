const pokeball = document.querySelector(".pokeball");
const pokeballbutton = document.querySelector(".pokeball__button");

window.onload = () => {
  pokeball.classList.add("pokeball--animation");
};

pokeball.addEventListener("mouseover", () => {
  pokeball.classList.remove("pokeball--animation");
});
