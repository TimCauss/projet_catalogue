const imgBgElement = document.querySelectorAll(".grid-p-img");

imgBgElement.forEach((img) => {
  img.addEventListener("mouseover", () => {
    console.log(img.getAttribute("data-p_type"));
  });
  img.addEventListener("mouseout", () => {
    console.log("tu mouse out !!!");
  });
});

function VerifType (arg) {
    
}