let radioYes = document.getElementById('r1');
let radioNo = document.getElementById('r2');
let years = document.getElementById('years');

radioYes.addEventListener('input',()=>{
  if(radioYes.checked){
    years.style.display='flex';
  }
})
radioNo.addEventListener('input',()=>{
  if(radioNo.checked){
    years.style.display='none';
  }
})