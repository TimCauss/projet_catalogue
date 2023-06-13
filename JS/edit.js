const pInputElem = document.querySelectorAll("#pInput");
const hInputElem = document.querySelectorAll("#hInput");
const btnValiderElem = document.querySelector("#valider");

btnValiderElem.addEventListener("click", () => {
  btnValiderElem.preventDefault();
  console.log(pInput);
  console.log(hInput);
});

function readURL(input) {
  if (input.files && input.files[0]) {
    let reader = new FileReader();
    console.log(reader);
    reader.onload = function (e) {
      document.getElementById("pokemon").setAttribute("src", e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
