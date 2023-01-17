

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
  $('.main-table').DataTable();
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

    $('.supplier_id').prepend('<option selected=""></option>').select2({
        placeholder: "Pilih Supplier",
        delay: 250,
        ajax: {
            dataType: 'json',
            type: 'GET',
            url: '/api/supplier_select',
            data: function(params) {
              return {
                  term: params.term
              }
            },
            processResults: function(data) {
              return {
                results: $.map(data, function(obj) {
                    return {
                        id: obj.id,
                        text: obj.nama_supplier,
                    };
                })
              };
            },
        }
      });

        $('.satuan_id').prepend('<option selected=""></option>').select2({
          placeholder: "Pilih Satuan",
          delay: 250,
                  ajax: {
                      dataType: 'json',
                      type: 'GET',
                      url: '/api/satuan_select',
                      data: function(params) {
                          return {
                              term: params.term
                          }
                      },
                      processResults: function(data) {
                          return {
                              results: $.map(data, function(obj) {
                                  return {
                                      id: obj.id,
                                      text: obj.kode_satuan,
                                  };
                              })
                          };
                      },
                  }
        });
    

});

function addValueKasir(inputID){
  let value = document.getElementById(inputID);
  let intValue = parseInt(value.value);
  intValue += 1;

  value.value = intValue;

}

function atcButton(event, inputKasir) {
  let button = event;
  let item = button.parentElement;
  let namaProduk = item.querySelector('.nama-produk').innerText;
  let harga = item.querySelector('.harga-produk').innerText;
  let merk = item.querySelector('.merk-produk').innerText;
  let pcs = item.querySelector(`#${inputKasir}`).value;

  console.log(namaProduk,harga,merk,pcs);
  addtocartItem(namaProduk,harga,merk,pcs);
  updateHarga(harga,pcs);
}
let sub = 0;
function updateHarga(harga,pcs){
  let subtotal = document.querySelector('.subtotal span');
  let pajak = document.querySelector('.tax span');
  sub += parseInt(harga) * parseInt(pcs)
  subtotal.innerText = sub;
  pajak.innerText = (sub * 11 / 100  );
}

function deleteCartItem(event){
  let button = event;
  let cartRow = button.parentNode.parentNode.parentNode;
  let harga = cartRow.querySelector('.harga-cart').innerText;
  let qty = cartRow.querySelector('.qty').value;
  let subtotal = document.querySelector('.subtotal span');
  let pajak = document.querySelector('.tax span');
  console.log(qty);
  sub = sub - parseInt(harga) * parseInt(qty);
  subtotal.innerText = sub;
  cartRow.parentNode.removeChild(cartRow); 
  pajak.innerText = (sub * 11 / 100  );
  
}

function addtocartItem(namaProduk,harga,merk,pcs){
  let cartRow = document.createElement('div');
  let cart = document.getElementsByClassName('cart')[0];
  let itemNames = document.getElementsByClassName('cart-nama');
  for (let i = 0 ; i < itemNames.length ; i++ ){
    if(itemNames[i].innerText == namaProduk){
      alert('Item Sudah Di Keranjang')
      return 
    }
  }
  cartRowContents = `<div class="item-cart tw-mb-3">
  <div class="tw-grid tw-grid-cols-3 tw-items-center tw-justify-between">
      <div class="tw-col-span-2 tw-pl-[20px]">
          <h3 class="tw-text-[16px] tw-font-bold cart-nama">${namaProduk}</h3>
          <p class="tw-text-prim-red tw-font-bold tw-text-[14px] tw-m-0 tw-mt-1 cart-harga">Rp. <span class="harga-cart">${harga}</span></p>
          <p class="tw-text-prim-black tw-text-[12px] tw-m-0 tw-mt-1 cart-merk">${merk}</p>
      </div>
  </div>
  <div class="deleteInput tw-mt-3 tw-grid tw-grid-cols-2 tw-justify-between tw-gap-5">
      <div class="input-group">
          <input type="text" class="form-control tw-w-2 tw-text-center qty" aria-label="Amount" id="jumlah-kasir" value="${pcs}" name="stok" disabled>
      </div>
      <div class="tw-ml-3">
          <button onclick="deleteCartItem(this)" class="tw-px-4 tw-py-1 tw-h-full">
              <p class="tw-m-0">Delete</p>
          </button>
      </div>
  </div>
</div>
</div>`
  cartRow.innerHTML = cartRowContents;
  cart.append(cartRow);
}



function minValueKasir(inputID){
  let value = document.getElementById(inputID);
  let intValue = parseInt(value.value);
  if(intValue > 0){
    intValue -= 1;
  } else {
    intValue = 0;
  }

  value.value = intValue;
}

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
                $('#trans_beli')[0].reset();
                $( '#trans_beli' ).each(function(){
                  location.reload();
              });
              // window.location.reload();
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
        error: function(response) {
          swal.fire(
            'Gagal',
            'Lengkapi Form',
            'warning'
        );
        }
    });
    return false;
});

$(document).on('submit', '#edittrans_beli', function(e) {
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
                  'Transaksi berhasil diubah',
                  'success'
              );
            //   $( '#edittrans_beli' ).each(function(){
            //     location.reload();
            // });
            window.location.href = "/transaksi/beli";
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
      error: function(response) {
        swal.fire(
          'Gagal',
          'Lengkapi Form',
          'warning'
      );
      }
  });
  return false;
});

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
                $('#retur_beli')[0].reset();
                $( '#retur_beli' ).each(function(){
                  location.reload();
              });
              
              // window.location.reload();
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

$(document).on('submit', '#editretur_beli', function(e) {
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
          //    $( '#editretur_beli' ).each(function(){
          //      location.reload();
          //  });
           window.location.href = "/transaksi/retur-beli";
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
              window.location.href='/transaksi/hutang';
         
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

