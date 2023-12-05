const delTrigger = document.querySelectorAll(".del-btn");
const redirBtn = document.querySelector(".go-del");

let id = 0;

delTrigger.forEach((del) => {
  del.addEventListener("click", () => {
    id = del.getAttribute("data-id").valueOf();
    console.log(id);
    $("#delModal").modal("show");
  });
});

redirBtn.addEventListener("click", () => {
  window.location.href = "includes/p_delete.php?p_id=" + id;
});
