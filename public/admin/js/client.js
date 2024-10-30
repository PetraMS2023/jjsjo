let input = document.getElementById("file2");
let imgInner = document.querySelector(".slider");

function removeImg(el) {
  el.parentElement.remove();
  let arr = Array.from(input.files);
  let filtered = arr.filter((e) => e.name !== el.dataset.name);
  const dataTransfer = new DataTransfer();
  filtered.forEach((file) => {
    dataTransfer.items.add(file);
  });
  input.files = dataTransfer.files;
}

input.addEventListener("input", () => {
  for (let i = 0; i < input.files.length; i++) {
    imgInner.innerHTML += `<div class="pImg">
    <img src="${URL.createObjectURL(input.files[i])}" alt="">
    <i class="fa-light fa-trash-can" data-name="${
      input.files[i].name
    }" onclick="removeImg(this)"></i>
  </div>
    `;
  }
});

let iconInput = document.getElementById("file5");
let iconInner = document.querySelector("#iconInner");

function removeVid(el) {
  el.parentElement.remove();
  let arr = Array.from(iconInput.files);
  let filtered = arr.filter((e) => e.name !== el.dataset.name);
  const dataTransfer = new DataTransfer();
  filtered.forEach((file) => {
    dataTransfer.items.add(file);
  });
  iconInput.files = dataTransfer.files;
}

iconInput.addEventListener("input", () => {
  const file = iconInput.files[0];
  const imgUrl = URL.createObjectURL(file);
  iconInner.innerHTML = `<div class="pImg oneImg">
  <img src="${imgUrl}" alt="" >
    <i class="fa-light fa-trash-can" data-name="${
      iconInput.files[0].name
    }" onclick="removeVid(this)"></i>
  </div>
    `;
});
