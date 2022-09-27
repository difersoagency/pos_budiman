// Class Active
let activeLink = document.querySelectorAll('.nav-link');
activeLink.forEach((element)=>{
  element.addEventListener('active',(e)=>{
    element.classList.toggle('tw-bg-prim-white');
  })
})

// Dropdown Sidebar
let dropdownMenu = document.querySelectorAll('.sidebar .has-submenu .sub-nav-link');

dropdownMenu.forEach(function(element){
  element.addEventListener('click',(e)=>{
    let submenu = element.nextElementSibling;

    submenu.classList.toggle("show");
    submenu.classList.toggle("collapse");
  })
})

// Datatable

// $(document).ready(function () {
//   $('#example').DataTable();
// });

// Select 2
$(document).ready(function() {
  $('.select-2').prepend('<option selected=""></option>').select2({placeholder: "Pilih Data"});
});
$(document).ready(function() {
  $(".input-select2").select2({
    dropdownParent: $("#modalPop")
  });

  $(".kota").select2({
    dropdownParent: $("#suppliermodal")
  });
});

// Modal Add Stok
// const buttonPlus = document.querySelector('.plus-btn');
// const buttonMin = document.querySelector('.min-btn');
// let stok = document.querySelector('#stok-barang');

// buttonPlus.addEventListener('click', function(){
//   if(stok.value >= 0){
//     buttonMin.disabled = false;
//   }
//   stok.value++;
// })

// buttonMin.addEventListener('click', function(){
//   if(stok.value < 2){
//     buttonMin.disabled = true;
//   }
//   stok.value--;
// })
