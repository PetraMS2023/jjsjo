let exit = document.querySelector("#exit");
let mes = document.querySelector(".mes");
let show = document.querySelectorAll("#edit");

exit.addEventListener("click", () => {
  mes.style.display = "none";
});

show.forEach((e) => {
  e.addEventListener("click", () => {
    mes.style.display = "flex";
  });
});

exit.addEventListener("click", () => {
  mes.style.display = "none";
});
