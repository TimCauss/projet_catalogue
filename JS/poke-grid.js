const imgBgElement = document.querySelectorAll(".grid-p-img");
const circle = document.querySelectorAll(".circle");
const pType = document.querySelectorAll(".grid-p-type1");
const pType2 = document.querySelectorAll(".grid-p-type2");

imgBgElement.forEach((img, i) => {
  img.addEventListener("mouseover", () => {
    VerifType(img, i);
  });
});

pType.forEach((type) => {
  verifTagType(type);
});
pType2.forEach((type) => {
  verifTagType(type);
});

function verifTagType(type) {
  if (type.innerHTML == "PLANTE") {
    type.style.background = "#68D037";
  } else if (type.innerHTML == "FEU") {
    type.style.background = "#E3350D";
  } else if (type.innerHTML == "EAU") {
    type.style.background = "#1E90FF";
  } else if (type.innerHTML == "GLACE") {
    type.style.background = "#1DFFFF";
  } else if (type.innerHTML == "INSECTE") {
    type.style.background = "#729f3f";
  } else if (type.innerHTML == "NORMAL") {
    type.style.background = "#CD853F";
  } else if (type.innerHTML == "ELECTRIK") {
    type.style.background = "#FFDB1D";
  } else if (type.innerHTML == "POISON") {
    type.style.background = "#800080";
  } else if (type.innerHTML == "PSY") {
    type.style.background = "#EE82EE";
  } else if (type.innerHTML == "COMBAT") {
    type.style.background = "#8B0000";
  } else if (type.innerHTML == "ACIER") {
    type.style.background = "#c0c0c0";
  } else if (type.innerHTML == "TENEBRES") {
    type.style.background = "#3d3d3d";
  } else if (type.innerHTML == "SPECTRE") {
    type.style.background = "#6E3C6E";
  } else if (type.innerHTML == "SOL") {
    type.style.background = "#B8860B";
  } else if (type.innerHTML == "ROCHE") {
    type.style.background = "#808080";
  } else if (type.innerHTML == "VOL") {
    type.style.background = "#82BAEF";
  } else {
    type.style.background = "#ffffff";
  }
}

function VerifType(elem, key) {
  if (elem.getAttribute("data-p_type") == "plante") {
    circle[key].style.background = "#68D03780";
  } else if (elem.getAttribute("data-p_type") == "feu") {
    circle[key].style.background = "#E3350D80";
  } else if (elem.getAttribute("data-p_type") == "eau") {
    circle[key].style.background = "#1E90FF80";
  } else if (elem.getAttribute("data-p_type") == "glace") {
    circle[key].style.background = "#1DFFFF80";
  } else if (elem.getAttribute("data-p_type") == "normal") {
    circle[key].style.background = "#CD853F80";
  } else if (elem.getAttribute("data-p_type") == "electrik") {
    circle[key].style.background = "#FFDB1D80";
  } else if (elem.getAttribute("data-p_type") == "poison") {
    circle[key].style.background = "#80008080";
  } else if (elem.getAttribute("data-p_type") == "insecte") {
    circle[key].style.background = "#729f3f80";
  } else if (elem.getAttribute("data-p_type") == "psy") {
    circle[key].style.background = "#EE82EE80";
  } else if (elem.getAttribute("data-p_type") == "combat") {
    circle[key].style.background = "#8B000080";
  } else if (elem.getAttribute("data-p_type") == "acier") {
    circle[key].style.background = "#c0c0c080";
  } else if (elem.getAttribute("data-p_type") == "tenebres") {
    circle[key].style.background = "#3d3d3d80";
  } else if (elem.getAttribute("data-p_type") == "spectre") {
    circle[key].style.background = "#6E3C6E80";
  } else if (elem.getAttribute("data-p_type") == "sol") {
    circle[key].style.background = "#B8860B80";
  } else if (elem.getAttribute("data-p_type") == "roche") {
    circle[key].style.background = "#80808080";
  } else if (elem.getAttribute("data-p_type") == "vol") {
    circle[key].style.background = "#82BAEF80";
  } else {
    circle.style.background = "#000000";
  }
}
