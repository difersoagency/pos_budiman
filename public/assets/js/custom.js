$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
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

$(document).ready(function () {
  $('#example').DataTable();
});

// Select 2
$(document).ready(function() {
  $('.select-2').prepend('<option selected=""></option>').select2({placeholder: "Pilih Data"});
  $('.select-user').prepend('<option selected=""></option>').select2({placeholder: "Pilih User"});
  $('.select-trans').prepend('<option selected=""></option>').select2({placeholder: "Pilih Barang"});
  $(".input-select2").select2({
    dropdownParent: $("#modalPop")
  });
});

function addRow(tableID) {
  var table = document.getElementById(tableID);
  var rowCount = table.rows.length;
  var row = table.insertRow(rowCount);
  var colCount = table.rows[0].cells.length;
  for(var i=0; i<colCount; i++) {
      var newcell = row.insertCell(i);
      newcell.innerHTML = table.rows[0].cells[i].innerHTML;
      var child = newcell.children;
      for(var i2=0; i2<child.length; i2++) {
          var test = newcell.children[i2].tagName;
          switch(test) {
              case "INPUT":
                  if(newcell.children[i2].type=='checkbox'){
                      newcell.children[i2].value = "";
                      newcell.children[i2].checked = false;
                  }else{
                      newcell.children[i2].value = "";
                  }
              break;
              case "SELECT":
                  newcell.children[i2].value = "";
              break;
              default:
              break;
          }
      }
  }
}