


// Datatable

$(document).ready(function () {
  $('#example').DataTable();
});


// Modal Add Stok
const buttonPlus = document.querySelector('.plus-btn');
const buttonMin = document.querySelector('.min-btn');
let stok = document.querySelector('#stok-barang');

buttonPlus.addEventListener('click', function(){
  if(stok.value >= 0){
    buttonMin.disabled = false;
  } 
  stok.value++;
})

buttonMin.addEventListener('click', function(){
  if(stok.value < 2){
    buttonMin.disabled = true;
  }
  stok.value--;
})