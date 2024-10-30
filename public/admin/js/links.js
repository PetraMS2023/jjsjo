let navLinks = document.querySelectorAll(".nLink");
navLinks.forEach((e) => {
  e.addEventListener("click", () => {
    navLinks.forEach((e) => {
      e.classList.remove("active");
    });
    e.classList.add("active");
  });
});

let menuBtn = document.getElementById("menu");
let dcont = document.querySelector('.dcont');

menuBtn.addEventListener("click", () => {
  dcont.classList.toggle("showNavLinks");
});

