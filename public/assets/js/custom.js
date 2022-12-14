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

  $(".kota").select2({
    dropdownParent: $("#suppliermodal")
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


$(function() {
  $(document).on('submit', '#trans_beli', function(e) {
    alert('ok');
     $('#trans_beli_submit').attr('disabled', true);
     e.preventDefault();
     var $form = $(this);
    var $inputs = $form.find("input, select, button, textarea");
    var serializedData = $form.serialize();
    var action = $(this).attr('action');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: action,
        data: serializedData,
        dataType: 'JSON',
        success: function(response) {
            // if (response['data'] == "success") {
            //     $("#tabel_penyakit > tbody").empty();
            //     numberRow_penyakit($("#tabel_penyakit"));
            //     $('#tabel_penyakit tbody').append(
            //         '<tr><td colspan="6">Data tidak tersedia</td></tr>');
            //     swal.fire(
            //         'Berhasil',
            //         'Data berhasil diupdate',
            //         'success'
            //     );
            // } else {
            //     swal.fire(
            //         'Error',
            //         'Data gagal di update',
            //         'warning'
            //     );
            // }
        },
        error: function(xhr, status, error) {
            swal.fire(
                'Gagal',
                'Lengkapi form',
                'warning'
            );
        }
    });
    return false;
})
});

