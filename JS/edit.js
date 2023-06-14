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
