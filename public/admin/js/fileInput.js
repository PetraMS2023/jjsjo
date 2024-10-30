let input = document.getElementById("file");
let imgInner = document.querySelector(".prImgs");

function removeImg(el) {
  el.parentElement.remove();
  let arr = Array.from(input.files)
  let filtered = arr.filter((e)=> e.name !== el.dataset.name);
  const dataTransfer = new DataTransfer();
  filtered.forEach(file => {
    dataTransfer.items.add(file);
  });
  input.files = dataTransfer.files;
  console.log(input.files);
}


input.addEventListener("input", () => {
  for (let i = 0; i < input.files.length; i++) {
    imgInner.innerHTML += `<div class="pImg">
    <img src="${URL.createObjectURL(input.files[i])}" alt="">
    <i class="fa-light fa-trash-can" data-name="${input.files[i].name}" onclick="removeImg(this)"></i>
  </div>
    `;
  }
});


