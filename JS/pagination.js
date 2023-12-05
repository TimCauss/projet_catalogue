const pagination = document.querySelectorAll(".paginations");

console.log(pagination);

window.onload = function () {
  if (
    window.location.href.indexOf("type=") > -1 ||
    window.location.href.indexOf("search=") > -1
  ) {
    pagination.forEach((e) => {
      e.style.display = "none";
    });
  } else {
    pagination.forEach((e) => {
      e.style.display = "block";
    });
  }
};