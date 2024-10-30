let input = document.getElementById("file");
let imgInner = document.querySelector(".prImgs");

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
  imgInner.innerHTML = `<div class="pImg oneImg">
    <img src="${URL.createObjectURL(input.files[0])}" alt="">
    <i class="fa-light fa-trash-can" data-name="${
      input.files[0].name
    }" onclick="removeImg(this)"></i>
  </div>
    `;
});
