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
