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

let videoInput = document.getElementById("file5");
let vInner = document.querySelector("#vInner");

function removeVid(el) {
  el.parentElement.remove();
  let arr = Array.from(videoInput.files);
  let filtered = arr.filter((e) => e.name !== el.dataset.name);
  const dataTransfer = new DataTransfer();
  filtered.forEach((file) => {
    dataTransfer.items.add(file);
  });
  videoInput.files = dataTransfer.files;
}

videoInput.addEventListener("input", () => {
  console.log(videoInput.value);
  const file = videoInput.files[0];
  const videourl = URL.createObjectURL(file);
  vInner.innerHTML = `<div class="pImg oneImg">
  <video src="${videourl}" muted controls></video>
    <i class="fa-light fa-trash-can" data-name="${
      videoInput.files[0].name
    }" onclick="removeVid(this)"></i>
  </div>
    `;
});
