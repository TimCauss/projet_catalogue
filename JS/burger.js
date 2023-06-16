const burger = document.querySelector(".burger");
const navMenu= document.querySelector(".menu-nav");

burger.addEventListener("click", () => {
    burger.classList.toggle("active");
    navMenu.classList.toggle("active");
})