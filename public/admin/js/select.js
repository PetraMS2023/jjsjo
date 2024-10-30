let selects = document.querySelectorAll('select');
selects.forEach(e => {
  e.addEventListener('input',()=>{
    if(e.value !== '0'){
      e.style.color="#d30202";
    }else{
      e.style.color="#787878";
    }
  })
  e.addEventListener('focus',()=>{
    e.parentElement.classList.add('activeSelect');
  })
  e.addEventListener('blur',()=>{
    e.parentElement.classList.remove('activeSelect');
  })
});
