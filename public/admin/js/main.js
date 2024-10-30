let i = document.querySelectorAll(".i");

i.forEach((e) => {
  e.addEventListener("click", () => {
    i.forEach((e) => {
      e.classList.remove("active");
    });
    e.classList.add("active");
  });
});


