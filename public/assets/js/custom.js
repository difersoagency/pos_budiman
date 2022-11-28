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
  $('.select-edit').select2();
  $('.select-2').prepend('<option selected=""></option>').select2({placeholder: "Pilih Data"});
  $('.select-user').prepend('<option selected=""></option>').select2({placeholder: "Pilih Data"});
  $('.select-trans').prepend('<option selected=""></option>').select2({placeholder: "Pilih Barang"});
  $(".input-select2").select2({
    dropdownParent: $("#modalPop")
  });
  $('.selects').select2();

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
    $('.select-trans').prepend('<option selected=""></option>').select2({placeholder: "Pilih Barang"});
    $('.select-trans').last().next().next().remove();
      var newcell = row.insertCell(i);
      newcell.innerHTML = table.rows[0].cells[i].innerHTML;
      var child = newcell.children;
      for(var i2=0; i2<child.length; i2++) {
          var test = newcell.children[i2].tagName;
      }
  }
}

function deleteRow(btn, tableId) {
  var table = document.getElementById(tableId);
  var rowCount = table.rows.length;
  var row = btn.parentNode.parentNode;
  if(rowCount > 1){
    
    row.parentNode.removeChild(row);  
  }
 
}

$(function() {
  $(document).on('submit', '#trans_beli', function(e) {
     e.preventDefault();
     var $form = $(this);
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
           if (response['data'] == "success") {
                swal.fire(
                    'Berhasil',
                    'Transaksi berhasil ditambahkan',
                    'success'
                );
                $( '#trans_beli' ).each(function(){
                  location.reload();
              });
           } else if(response['data'] == "dibayar"){
                swal.fire(
                    'Gagal',
                    'Total dibayar harus lebih kecil dari total transaksi',
                    'warning'
                );
           } else {
                swal.fire(
                    'Gagal',
                    'Lengkapi Form',
                    'warning'
                );
           }
       
        },
        error: function(xhr, status, error) {
          swal.fire(
            'Gagal',
            'Lengkapi Form',
            'warning'
        );
        }
    });
    return false;
})
  $(document).on('submit', '#retur_beli', function(e) {
     e.preventDefault();
     var $form = $(this);
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
           if (response['data'] == "success") {
                swal.fire(
                    'Berhasil',
                    'Transaksi berhasil ditambahkan',
                    'success'
                );
                $( '#trans_beli' ).each(function(){
                  location.reload();
              });
           } else if(response['data'] == "dibayar"){
                swal.fire(
                    'Gagal',
                    'Total dibayar harus lebih kecil dari total transaksi',
                    'warning'
                );
           } else {
                swal.fire(
                    'Gagal',
                    'Lengkapi Form',
                    'warning'
                );
           }
       
        },
        error: function(xhr, status, error) {
          swal.fire(
            'Gagal',
            'Lengkapi Form',
            'warning'
        );
        }
    });
    return false;
})
  $(document).on('submit', '#trans_hutang', function(e) {
     e.preventDefault();
     var $form = $(this);
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
           if (response['data'] == "success") {
                swal.fire(
                    'Berhasil',
                    'Transaksi berhasil ditambahkan',
                    'success'
                );
                $( '#hutang' ).each(function(){
                  location.reload();
              });
         
           } else if( response['data'] == "total_gagal"){
                swal.fire(
                    'Gagal',
                    'Total di bayar lebih besar dari total hutang',
                    'warning'
                );
           } else {
                swal.fire(
                    'Gagal',
                    'Lengkapi Form',
                    'warning'
                );
           }
       
        },
        error: function(xhr, status, error) {
          swal.fire(
            'Gagal',
            'Lengkapi Form',
            'warning'
        );
        }
    });
    return false;
})
});

