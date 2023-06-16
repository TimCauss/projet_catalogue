const cards = document.querySelectorAll(".type-card");
const url = "/projet_catalogue/pokedex.php?type=";

cards.forEach((e, k) => {
  e.addEventListener("click", () => {
    if (k == 0) {
      window.location.href = url + "Feu";
    } else if (k == 1) {
      window.location.href = url + "Plante";
    } else if (k == 2) {
      window.location.href = url + "Eau";
    } else if (k == 3) {
      window.location.href = url + "Glace";
    } else if (k == 4) {
      window.location.href = url + "Normal";
    } else if (k == 5) {
      window.location.href = url + "Electrik";
    } else if (k == 6) {
      window.location.href = url + "Poison";
    } else if (k == 7) {
      window.location.href = url + "Insecte";
    } else if (k == 8) {
      window.location.href = url + "Psy";
    } else if (k == 9) {
      window.location.href = url + "Combat";
    } else if (k == 10) {
      window.location.href = url + "Acier";
    } else if (k == 11) {
      window.location.href = url + "Tenebres";
    } else if (k == 12) {
      window.location.href = url + "Roche";
    } else if (k == 13) {
      window.location.href = url + "Sol";
    } else if (k == 14) {
      window.location.href = url + "Spectre";
    } else if (k == 15) {
      window.location.href = url + "Vol";
    } else if (k == 16) {
      window.location.href = url + "Dragon";
    } else {
      window.location.href = url + "Fee";
    }
  });
});
